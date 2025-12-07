<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-guest/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets-guest/lib/lightbox/js/lightbox.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets-guest/js/main.js') }}"></script>

<!-- Custom App JS -->
<script src="{{ asset('assets-guest/resources/js/app.js') }}"></script>

@stack('scripts')

{{-- js warga index --}}
<script>
    // Detail button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.btn-detail');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.user-card');
                const email = card.querySelector('.email').textContent;
                const userId = card.querySelector('.user-id').textContent;

                // Show user details in modal or alert
                alert(`Detail User:\n${email}\n${userId}`);
            });
        });

        // Add animation delay to cards
        const cards = document.querySelectorAll('.user-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>

{{-- js perangkat index --}}
<script>
    // Detail button functionality
    function showDetail(perangkatId) {
        // You can implement modal or redirect to detail page
        // For now, using alert as placeholder
        alert(`Menampilkan detail perangkat dengan ID: ${perangkatId}`);

        // Example for modal implementation:
        // $('#detailModal').modal('show');
        // Load detail data via AJAX
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Add animation delay to cards
        const cards = document.querySelectorAll('.perangkat-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Search functionality (if needed)
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.perangkat-card');

                cards.forEach(card => {
                    const nama = card.querySelector('.nama').textContent.toLowerCase();
                    const jabatan = card.querySelector('.jabatan').textContent.toLowerCase();

                    if (nama.includes(searchTerm) || jabatan.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>

{{-- js user index --}}
<script>
    // Detail button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.btn-detail');

        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.user-card');
                const email = card.querySelector('.email').textContent;
                const userId = card.querySelector('.user-id').textContent;

                // Show user details in modal or alert
                alert(`Detail User:\n${email}\n${userId}`);
            });
        });

        // Add animation delay to cards
        const cards = document.querySelectorAll('.user-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>

{{--  js navbar  --}}
<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- js jabatan index --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi hapus
        const deleteForms = document.querySelectorAll('form[action*="jabatan-lembaga"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });

        // Animasi cards
        const cards = document.querySelectorAll('.jabatan-card, .card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>

<script>
    // Preview logo sebelum upload
    document.getElementById('logo').addEventListener('change', function(e) {
        const preview = document.getElementById('logo-preview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
