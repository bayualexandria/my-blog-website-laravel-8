 feather.replace();

        const nav = document.querySelector('nav');
        const header = document.getElementById('header');

        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 50) {
                nav.classList.add('bg-white', 'shadow');
                header.classList.add('position-fixed');

            } else {
                header.classList.remove('position-fixed');
                nav.classList.remove('bg-white', 'shadow');
            }
        })

        $('.navbar-toggler').on('click', function () {
            nav.classList.add('bg-white', 'shadow');
        });

        $('.nav-link').on('click', function () {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
        }); 
        
        $('.btn-circle').on('click', function () {
            $('.btn-circle').removeClass('active-btn-circle');
            $(this).addClass('active-btn-circle');
        });
