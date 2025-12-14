var UserDashboardService = {
    init: function() {
        setTimeout(() => {
            const section = document.getElementById('user-dashboard');
            if (!section) return;

            if (this._handler) {
                section.removeEventListener('click', this._handler);
            }

            this._handler = function(e) {
                const target = e.target;
                if (target.id === 'btn-load-my-appointments') {
                    e.preventDefault();
                    UserDashboardService.loadMyAppointments();
                }
            };

            section.addEventListener('click', this._handler);
        }, 0);
    },

    loadMyAppointments: function() {
        const user = UserService.currentUser();
        if (!user) {
            this.setStatus('Please log in to view your appointments.', 'error');
            return;
        }
        const userId = user.user_id || user.id;
        if (!userId) {
            this.setStatus('User id missing in token.', 'error');
            return;
        }

        this.setStatus('Loading appointments...');
        RestClient.get(`appointments/user/${userId}`, (data) => {
            this.setStatus('');
            this.renderTable(data);
        }, (err) => {
            this.setStatus('Error loading appointments', 'error');
            console.error(err);
        });
    },

    setStatus: function(msg, type) {
        var el = document.getElementById('user-status');
        if (!el) return;
        if (!msg) {
            el.style.display = 'none';
            el.textContent = '';
            return;
        }
        el.style.display = 'block';
        el.textContent = msg;
        el.className = 'alert ' + (type === 'error' ? 'alert-danger' : 'alert-info');
    },

    renderTable: function(data) {
        const table = document.getElementById('user-table');
        if (!table) return;
        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');
        thead.innerHTML = '';
        tbody.innerHTML = '';

        if (!data) return;
        const rows = Array.isArray(data) ? data : [data];
        if (rows.length === 0) {
            this.setStatus('No appointments found.');
            return;
        }

        const headers = Object.keys(rows[0]);
        const headRow = document.createElement('tr');
        headers.forEach(h => {
            const th = document.createElement('th');
            th.textContent = h;
            headRow.appendChild(th);
        });
        thead.appendChild(headRow);

        rows.forEach(r => {
            const tr = document.createElement('tr');
            headers.forEach(h => {
                const td = document.createElement('td');
                td.textContent = r[h];
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
    }
};

$(document).ready(function() {
    UserDashboardService.init();
});

