var AdminService = {
    currentEntity: null,
    _listenersAttached: false,

    init: function(retryCount = 0) {
        const section = document.getElementById('admin-dashboard');
        if (!section) {
            if (retryCount < 10) {
                setTimeout(() => this.init(retryCount + 1), 150);
            }
            return;
        }

        if (!this._listenersAttached) {
            this.attachListeners();
            this._listenersAttached = true;
        }
    },

    attachListeners: function() {
        // clean old listeners
        if (this._clickHandler) document.removeEventListener('click', this._clickHandler, true);
        if (this._submitHandler) document.removeEventListener('submit', this._submitHandler, true);

        this._clickHandler = (e) => {
            const target = e.target;
            const action = target.getAttribute('data-action');
            const entity = target.getAttribute('data-entity');

            // entity button -> open ops modal
            if (action === 'open-ops' && entity) {
                e.preventDefault();
                this.currentEntity = entity;
                this.stampOpsButtons(entity);
                this.openModal('modal-ops');
                return;
            }

            // ops modal buttons
            if (action && !entity && this.currentEntity) {
                target.setAttribute('data-entity', this.currentEntity);
            }

            if (action && (entity || this.currentEntity)) {
                e.preventDefault();
                this.handleAction(entity || this.currentEntity, action);
                return;
            }

            // close modal via overlay click
            if (target.classList.contains('modal-overlay')) {
                target.style.display = 'none';
            }
            if (target.classList.contains('close-modal')) {
                const modalId = target.getAttribute('data-modal');
                if (modalId) this.closeModal(modalId);
            }
        };

        this._submitHandler = (e) => {
            const form = e.target;
            if (!form.id) return;
            const parts = form.id.split('-'); // form-<entity>-<action>
            if (parts.length !== 3) return;
            const entity = parts[1];
            const action = parts[2];
            e.preventDefault();
            this.submit(entity, action);
        };

        document.addEventListener('click', this._clickHandler, true);
        document.addEventListener('submit', this._submitHandler, true);
    },

    stampOpsButtons: function(entity) {
        document.querySelectorAll('#modal-ops [data-action]').forEach((btn) => {
            btn.setAttribute('data-entity', entity);
        });
        const title = document.getElementById('ops-title');
        if (title) title.textContent = `Choose action for ${entity}`;
    },

    handleAction: function(entity, action) {
        this.closeAllModals();
        if (action === 'list') return this.listAll(entity);
        if (action === 'add-open') return this.openModal(`modal-${entity}-add`);
        if (action === 'update-open') return this.openModal(`modal-${entity}-update`);
        if (action === 'delete-open') return this.openModal(`modal-${entity}-delete`);
    },

    submit: function(entity, action) {
        const form = document.getElementById(`form-${entity}-${action}`);
        if (!form) {
            this.setStatus('Form not found for ' + entity + ' ' + action, 'error');
            return;
        }
        const data = Object.fromEntries(new FormData(form).entries());

        if (action === 'add') return this.add(entity, data);
        if (action === 'update') {
            const id = data[this.idKey(entity)];
            return this.update(entity, id, data);
        }
        if (action === 'delete') {
            const id = data[this.idKey(entity)];
            return this.remove(entity, id);
        }
    },

    idKey: function(entity) {
        if (entity === 'appointments') return 'appointment_id';
        if (entity === 'users') return 'user_id';
        if (entity === 'dentists') return 'dentist_id';
        if (entity === 'services') return 'service_id';
        return 'id';
    },

    listAll: function(entity) {
        this.setStatus('Loading ' + entity + '...');
        RestClient.get(entity, (data) => {
            this.setStatus('');
            this.renderTable(data);
        }, (err) => {
            this.setStatus('Error loading ' + entity, 'error');
            console.error(err);
        });
    },

    add: function(entity, data) {
        this.setStatus('Adding ' + entity + '...');
        RestClient.post(entity, data, () => {
            this.setStatus('Added successfully', 'success');
            this.closeAllModals();
            this.listAll(entity);
        }, (err) => {
            this.setStatus('Error adding', 'error');
            console.error(err);
        });
    },

    update: function(entity, id, data) {
        if (!id) return this.setStatus('Missing ID for update', 'error');
        this.setStatus('Updating ' + entity + '...');
        RestClient.put(`${entity}/${id}`, data, () => {
            this.setStatus('Updated successfully', 'success');
            this.closeAllModals();
            this.listAll(entity);
        }, (err) => {
            this.setStatus('Error updating', 'error');
            console.error(err);
        });
    },

    remove: function(entity, id) {
        if (!id) return this.setStatus('Missing ID for delete', 'error');
        this.setStatus('Deleting ' + entity + '...');
        RestClient.delete(`${entity}/${id}`, {}, () => {
            this.setStatus('Deleted successfully', 'success');
            this.closeAllModals();
            this.listAll(entity);
        }, (err) => {
            this.setStatus('Error deleting', 'error');
            console.error(err);
        });
    },

    openModal: function(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        const inputs = modal.querySelectorAll('input, select');
        inputs.forEach(i => i.value = '');
        modal.style.display = 'flex';
        // ensure inner content (admin-modal) is visible even with Bootstrap modal styles
        const inner = modal.querySelector('.admin-modal');
        if (inner) inner.style.display = 'block';
    },

    closeModal: function(id) {
        const modal = document.getElementById(id);
        if (modal) modal.style.display = 'none';
    },

    closeAllModals: function() {
        document.querySelectorAll('.modal-overlay').forEach(m => m.style.display = 'none');
    },

    setStatus: function(msg, type) {
        var el = document.getElementById('admin-status');
        if (!el) return;
        if (!msg) {
            el.style.display = 'none';
            el.textContent = '';
            return;
        }
        el.style.display = 'block';
        el.textContent = msg;
        el.className = 'alert ' + (type === 'error' ? 'alert-danger' : type === 'success' ? 'alert-success' : 'alert-info');
    },

    renderTable: function(data) {
        const table = document.getElementById('admin-table');
        if (!table) return;
        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');
        thead.innerHTML = '';
        tbody.innerHTML = '';

        if (!data) return;
        const rows = Array.isArray(data) ? data : [data];
        console.log(rows);
        
        if (rows.length === 0) return;

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
    AdminService.init();
});

