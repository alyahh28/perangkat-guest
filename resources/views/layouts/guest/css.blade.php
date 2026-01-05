<meta charset="utf-8">
<title>@yield('title', 'PERANGKAT & LEMBAGA')</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Favicon -->
<link href="{{ asset('assets-guest/favicon.ico') }}" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap"
    rel="stylesheet">

<!-- START CSS -->
<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('assets-guest/lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets-guest/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets-guest/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Custom App CSS -->
{{-- <link href="{{ asset('assets-guest/resources/css/app.css') }}" rel="stylesheet"> --}}

<!-- Template Stylesheet -->
<link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet">
<!-- END CSS -->

{{-- css warga index --}}
<style>
    .user-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .card-header .email {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-header .user-id {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 600;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-aktif {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .status-nonaktif {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid #f1f3f4;
        padding: 1rem 1.5rem;
        border-radius: 0 0 15px 15px !important;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .btn-detail:hover,
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }

    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Grid layout */
    .user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .user-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card-footer .d-flex {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-action {
            width: 100%;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

{{-- css perangkat index --}}
<style>
    .perangkat-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
    }

    .perangkat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .card-header .nama {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-header .jabatan {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 600;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-aktif {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .status-nonaktif {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid #f1f3f4;
        padding: 1rem 1.5rem;
        border-radius: 0 0 15px 15px !important;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .btn-detail:hover,
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }

    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Grid layout */
    .perangkat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .perangkat-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card-footer .d-flex {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-action {
            width: 100%;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .perangkat-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        margin-right: 1rem;
    }

    .header-content {
        display: flex;
        align-items: center;
    }

    .foto-perangkat {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        margin-right: 1rem;
    }
</style>

{{-- css user index --}}
<style>
    .user-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .card-header .email {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-header .user-id {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 600;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-aktif {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .status-nonaktif {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid #f1f3f4;
        padding: 1rem 1.5rem;
        border-radius: 0 0 15px 15px !important;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .btn-detail:hover,
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }

    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Grid layout */
    .user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .user-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card-footer .d-flex {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-action {
            width: 100%;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
{{--  css icon  --}}

{{--  css WA  --}}
<link type="text/css" href="{{ asset('assets-guest/css/floating.css') }}" rel="stylesheet">

{{-- css jabatan index --}}
<style>
    .jabatan-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
    }

    .jabatan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .level-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .jabatan-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

{{-- LEMBAGA --}}
<style>
    .lembaga-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        margin-bottom: 2rem;
    }

    .lembaga-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .card-header .nama-lembaga {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-header .kontak {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .info-value {
        color: #2c3e50;
        font-weight: 600;
        text-align: right;
        max-width: 60%;
    }

    .card-footer {
        background: transparent;
        border-top: 1px solid #f1f3f4;
        padding: 1rem 1.5rem;
        border-radius: 0 0 15px 15px !important;
    }

    .btn-action {
        border-radius: 10px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.85rem;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .btn-detail:hover,
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Grid layout */
    .lembaga-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2rem;
    }

    @media (max-width: 768px) {
        .lembaga-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card-footer .d-flex {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-action {
            width: 100%;
            text-align: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .lembaga-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        margin-right: 1rem;
    }

    .header-content {
        display: flex;
        align-items: center;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: center;
    }

    .action-buttons .btn {
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        width: 100%;
        max-width: 120px;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
    }

    /* Untuk tampilan desktop yang lebih lebar */
    @media (min-width: 992px) {
        .action-buttons {
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            width: auto;
            min-width: 80px;
        }
    }
</style>
{{-- 2 --}}
<style>
    .lembaga-form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .lembaga-form-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-control-lg {
        font-size: 1.1rem;
    }

    .btn-lg {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
    }
</style>

{{-- 3 --}}
<style>
    .lembaga-form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .lembaga-form-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        border: none;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-control-lg {
        font-size: 1.1rem;
    }

    .btn-lg {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
    }
</style>


{{-- jataban css --}}
<style>
/* Modern Styling */
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    border-radius: 15px;
    color: white;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.section-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 1rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

.modern-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border: none;
    transition: all 0.3s ease;
    overflow: hidden;
    height: 100%;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.15);
}

.card-header-section {
    padding: 1.5rem 1.5rem 1rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.card-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.card-title-section {
    flex: 1;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.card-subtitle {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0;
}

.card-divider {
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    margin: 0 1.5rem;
}

.card-body-section {
    padding: 1.5rem;
}

.info-grid {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
}

.info-value {
    color: #6c757d;
    font-size: 0.875rem;
    text-align: right;
    flex: 1;
    margin-left: 1rem;
}

.level-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.level-1 { background: #e3f2fd; color: #1976d2; }
.level-2 { background: #e8f5e8; color: #2e7d32; }
.level-3 { background: #fff3e0; color: #f57c00; }
.level-4 { background: #fce4ec; color: #c2185b; }

.card-footer-section {
    padding: 1rem 1.5rem 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-add {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.empty-state {
    background: white;
    border-radius: 15px;
    padding: 3rem;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

.empty-icon {
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }

    .page-title {
        font-size: 2rem;
    }

    .card-header-section {
        flex-direction: column;
        text-align: center;
    }

    .card-icon {
        align-self: center;
    }

    .info-row {
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-value {
        text-align: left;
        margin-left: 0;
    }

    .action-buttons {
        justify-content: center;
    }
}
</style>


{{-- LD --}}
<style>
/* Modern Styling */
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
    border-radius: 15px;
    color: white;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.section-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 1rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

.modern-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border: none;
    transition: all 0.3s ease;
    overflow: hidden;
    height: 100%;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.15);
}

.card-header-section {
    padding: 1.5rem 1.5rem 1rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.card-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.card-title-section {
    flex: 1;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.card-subtitle {
    color: #6c757d;
    font-size: 0.875rem;
    margin-bottom: 0;
}

.card-divider {
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    margin: 0 1.5rem;
}

.card-body-section {
    padding: 1.5rem;
}

.info-grid {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
}

.info-value {
    color: #6c757d;
    font-size: 0.875rem;
    text-align: right;
    flex: 1;
    margin-left: 1rem;
}

.card-footer-section {
    padding: 1rem 1.5rem 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-add {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.empty-state {
    background: white;
    border-radius: 15px;
    padding: 3rem;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

.empty-icon {
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }

    .page-title {
        font-size: 2rem;
    }

    .card-header-section {
        flex-direction: column;
        text-align: center;
    }

    .card-icon {
        align-self: center;
    }

    .info-row {
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-value {
        text-align: left;
        margin-left: 0;
    }

    .action-buttons {
        justify-content: center;
    }
}
</style>

<style>
        .filter-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }
        .form-select, .form-control {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 8px;
            height: 45px;
        }
        .btn-outline-secondary {
            border-radius: 8px;
            height: 45px;
        }
        .perangkat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .perangkat-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>

<style>
    /* Card Styles */
    .modern-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: hidden;
        height: 100%;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
    }

    .modern-card:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        transform: translateY(-5px);
        border-color: #dee2e6;
    }

    /* Header Section inside Card */
    .card-header-section {
        display: flex;
        align-items: center;
        padding: 20px;
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        border-bottom: 1px solid #f0f0f0;
    }

    .card-icon {
        flex-shrink: 0;
        margin-right: 15px;
    }

    /* Logo Styling */
    .logo-img {
        width: 60px;
        height: 60px;
        object-fit: cover; /* Mencegah gambar gepeng */
        border-radius: 12px;
        border: 1px solid #dee2e6;
        background: #fff;
    }

    .default-logo-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    /* Title & Text */
    .card-title-section {
        flex: 1;
        overflow: hidden;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-subtitle {
        font-size: 0.8rem;
        color: #718096;
        margin: 0;
        display: flex;
        align-items: center;
    }

    /* Body Section */
    .card-body-section {
        padding: 20px;
        flex: 1; /* Agar footer selalu di bawah */
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        border-bottom: 1px dashed #f0f0f0;
        padding-bottom: 8px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #4a5568;
    }

    .info-value {
        color: #718096;
        text-align: right;
        max-width: 60%;
    }

    /* Footer & Buttons */
    .card-footer-section {
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr; /* 3 Tombol sejajar */
        gap: 8px;
    }

    .btn-action {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    /* Empty State */
    .empty-state {
        background: #fff;
        border-radius: 16px;
        padding: 60px 20px;
        border: 2px dashed #cbd5e0;
    }
</style>
