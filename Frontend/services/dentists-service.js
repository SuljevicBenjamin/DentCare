var DentistsService = {
    state: {
        dentists: [],
        container: null
    },

    init: function() {
        this.state.container = document.getElementById('dentists-container');
        
        if (!this.state.container) {
            console.warn('Dentists container not found');
            return;
        }
        
        this.fetchDentists();
    },

    fetchDentists: function() {
        var self = this;
        
        if (typeof RestClient === 'undefined') {
            console.error('RestClient is not defined');
            return;
        }

        RestClient.get('dentists/public', function(data) {
            self.state.dentists = Array.isArray(data) ? data : [];
            self.render();
        }, function(err) {
            console.error('Error fetching dentists:', err);
            
            
            if (err.status === 200 && err.responseText) {
                try {
                    var data = JSON.parse(err.responseText.trim());
                    self.state.dentists = Array.isArray(data) ? data : [];
                    self.render();
                    return;
                } catch (parseError) {
                    console.error('Parse error:', parseError);
                }
            }
            
            
            self.state.container.innerHTML = '<div class="col-12"><p class="text-center">Unable to load dentists. Please try again later.</p></div>';
        });
    },

    render: function() {
        var container = this.state.container;
        var dentists = this.state.dentists;

        
        var loadingDiv = container.querySelector('.col-12.col-lg-8');
        if (loadingDiv) {
            loadingDiv.remove();
        }

        if (!dentists || !dentists.length) {
            var errorHtml = '<div class="col-12"><p class="text-center">No dentists available at the moment.</p></div>';
            container.insertAdjacentHTML('beforeend', errorHtml);
            return;
        }

        var html = dentists.map(function(dentist, index){
            var fullName = dentist.full_name || 'Doctor';
            var specialization = dentist.specialization || 'Specialist';
            var imageUrl = dentist.image_url || '/web/Frontend/assets/img/team-' + ((index % 5) + 1) + '.jpg';
            
            
            var delay = (((index + 1) % 3) * 0.3 + 0.3).toFixed(1);

            return `
                <div class="col-lg-4 wow slideInUp" data-wow-delay="${delay}s">
                    <div class="team-item">
                        <div class="position-relative rounded-top" style="z-index: 1;">
                            <img class="img-fluid rounded-top w-100" src="${imageUrl}" alt="${fullName}" 
                                 onerror="this.src='/web/Frontend/assets/img/team-${((index % 5) + 1)}.jpg'">
                            <div class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex">
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square m-1" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5">
                            <h4 class="mb-2">${fullName}</h4>
                            <p class="text-primary mb-0">${specialization}</p>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        
        container.insertAdjacentHTML('beforeend', html);

        
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
    }
};


document.addEventListener('DOMContentLoaded', function(){
    
    if (typeof $.spapp !== 'undefined') {
        $(document).on('spapp-init', function() {
            setTimeout(function() {
                if (window.location.hash.includes('page5') || document.getElementById('dentists-container')) {
                    DentistsService.init();
                }
            }, 100);
        });
    }
    
    
    setTimeout(function() {
        if (document.getElementById('dentists-container')) {
            DentistsService.init();
        }
    }, 500);
});


window.DentistsService = DentistsService;

