<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-guest/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/lightbox/js/lightbox.min.js') }}"></script>

<script src="{{ asset('assets-guest/js/main.js') }}"></script>

<script src="{{ asset('assets-guest/resources/js/app.js') }}"></script>

@stack('scripts')

<script>
    // Logic Spinner dari Template Baru biasanya ada di main.js,
    // tapi kita pastikan di sini agar hilang setelah load
    $(window).on('load', function () {
        if ($('#spinner').length > 0) {
            $('#spinner').removeClass('show');
        }
    });

    // Pindahkan Logic Pencarian & Confirm Delete ke sini jika app.js belum diload dengan benar
    document.addEventListener('DOMContentLoaded', function() {
        // ... (Script pencarian Anda tetap bisa digunakan di sini)
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // 1. ANIMASI CARD
        const allCards = document.querySelectorAll('.user-card, .perangkat-card, .jabatan-card, .card');
        allCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // 2. FITUR PENCARIAN (Perangkat)
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.perangkat-card');

                cards.forEach(card => {
                    const namaEl = card.querySelector('.nama');
                    const jabatanEl = card.querySelector('.jabatan');

                    if (namaEl && jabatanEl) {
                        const nama = namaEl.textContent.toLowerCase();
                        const jabatan = jabatanEl.textContent.toLowerCase();

                        if (nama.includes(searchTerm) || jabatan.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        }

        // 3. KONFIRMASI HAPUS (Global)
        // Mencegah hapus tidak sengaja
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });

        // 4. PREVIEW LOGO/FOTO
        const logoInput = document.getElementById('logo'); // atau id 'foto'
        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const preview = document.getElementById('logo-preview'); // Pastikan ada img dengan id ini di form
                const file = e.target.files[0];

                if (file && preview) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
