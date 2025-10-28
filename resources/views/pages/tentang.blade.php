<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Platform Pembelajaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
        }

        header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.2rem;
            color: #2c3e50;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border-radius: 2px;
        }

        .section-title p {
            color: #7f8c8d;
            max-width: 700px;
            margin: 0 auto;
        }

        .modules-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .module-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .module-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .module-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .module-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .module-card:hover .module-image img {
            transform: scale(1.05);
        }

        .module-content {
            padding: 25px;
        }

        .module-content h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .module-content p {
            color: #555;
            margin-bottom: 20px;
        }

        .module-objectives {
            margin-top: 20px;
        }

        .module-objectives h4 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #3498db;
        }

        .module-objectives ul {
            list-style-type: none;
            padding-left: 0;
        }

        .module-objectives li {
            padding: 8px 0;
            padding-left: 25px;
            position: relative;
            color: #555;
        }

        .module-objectives li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #2ecc71;
            font-weight: bold;
        }

        .workflow-section {
            background-color: #f1f8ff;
        }

        .workflow-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .workflow-step {
            display: flex;
            align-items: center;
            gap: 30px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .step-number {
            min-width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .step-content {
            flex: 1;
        }

        .step-content h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .step-image {
            width: 200px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
        }

        .step-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        /* Controller Styles */
        .controller-panel {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .controller-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }

        .controller-options {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .controller-btn {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .controller-btn:hover {
            background: #2980b9;
        }

        .controller-btn.active {
            background: #2c3e50;
        }

        .controller-slider {
            width: 100%;
            margin: 20px 0;
        }

        .slider-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .slider-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .slider-value {
            min-width: 40px;
            text-align: center;
            font-weight: bold;
            color: #3498db;
        }

        input[type="range"] {
            flex: 1;
            height: 8px;
            -webkit-appearance: none;
            background: #e0e0e0;
            border-radius: 4px;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: #3498db;
            border-radius: 50%;
            cursor: pointer;
        }

        .color-picker {
            display: flex;
            gap: 10px;
            align-items: center;
            margin: 15px 0;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.2s ease;
        }

        .color-option:hover {
            transform: scale(1.1);
        }

        .color-option.active {
            border-color: #2c3e50;
        }

        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #3498db;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        @media (max-width: 768px) {
            .workflow-step {
                flex-direction: column;
                text-align: center;
            }

            .step-image {
                width: 100%;
                max-width: 300px;
            }

            header h1 {
                font-size: 2.2rem;
            }

            .controller-options {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Tentang Platform Pembelajaran Kami</h1>
            <p>Platform pembelajaran inovatif yang dirancang untuk membantu Anda menguasai keterampilan baru dengan metode yang efektif dan menyenangkan.</p>
        </div>
    </header>

    <section class="modules-section">
        <div class="container">
            <!-- Controller Panel -->
            <div class="controller-panel">
                <h3 class="controller-title">Kontrol Tampilan Modul</h3>

                <div class="controller-options">
                    <button class="controller-btn active" id="view-all">Tampilkan Semua</button>
                    <button class="controller-btn" id="view-basic">Modul Dasar</button>
                    <button class="controller-btn" id="view-intermediate">Modul Menengah</button>
                    <button class="controller-btn" id="view-advanced">Modul Lanjutan</button>
                </div>

                <div class="controller-slider">
                    <div class="slider-label">
                        <span>Ukuran Kartu Modul:</span>
                        <span id="card-size-value">Sedang</span>
                    </div>
                    <div class="slider-container">
                        <span>Kecil</span>
                        <input type="range" min="1" max="3" value="2" id="card-size-slider">
                        <span>Besar</span>
                        <span class="slider-value" id="card-size-display">2</span>
                    </div>
                </div>

                <div class="color-picker">
                    <span>Warna Tema:</span>
                    <div class="color-option active" style="background-color: #3498db;" data-color="#3498db"></div>
                    <div class="color-option" style="background-color: #2ecc71;" data-color="#2ecc71"></div>
                    <div class="color-option" style="background-color: #e74c3c;" data-color="#e74c3c"></div>
                    <div class="color-option" style="background-color: #9b59b6;" data-color="#9b59b6"></div>
                    <div class="color-option" style="background-color: #f39c12;" data-color="#f39c12"></div>
                </div>

                <div class="toggle-container">
                    <span>Mode Gelap:</span>
                    <label class="toggle-switch">
                        <input type="checkbox" id="dark-mode-toggle">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <div class="section-title">
                <h2>Modul Pembelajaran</h2>
                <p>Kami menyediakan berbagai modul pembelajaran yang dirancang khusus untuk mencapai tujuan spesifik Anda</p>
            </div>

            <div class="modules-container" id="modules-container">
                <!-- Modul 1 -->
                <div class="module-card" data-category="basic">
                    <div class="module-image">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Modul Dasar">
                    </div>
                    <div class="module-content">
                        <h3>Modul Dasar</h3>
                        <p>Modul ini dirancang untuk pemula yang ingin memahami konsep dasar sebelum melanjutkan ke tingkat yang lebih tinggi.</p>
                        <div class="module-objectives">
                            <h4>Tujuan Pembelajaran:</h4>
                            <ul>
                                <li>Memahami konsep fundamental</li>
                                <li>Membangun pondasi pengetahuan yang kuat</li>
                                <li>Menguasai terminologi dasar</li>
                                <li>Mempersiapkan diri untuk modul lanjutan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modul 2 -->
                <div class="module-card" data-category="intermediate">
                    <div class="module-image">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Modul Menengah">
                    </div>
                    <div class="module-content">
                        <h3>Modul Menengah</h3>
                        <p>Modul ini mengembangkan keterampilan yang telah dipelajari di modul dasar dengan penerapan yang lebih kompleks.</p>
                        <div class="module-objectives">
                            <h4>Tujuan Pembelajaran:</h4>
                            <ul>
                                <li>Mengaplikasikan konsep dasar dalam situasi nyata</li>
                                <li>Mengembangkan kemampuan analisis</li>
                                <li>Memecahkan masalah dengan pendekatan sistematis</li>
                                <li>Membangun keterampilan praktis</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modul 3 -->
                <div class="module-card" data-category="advanced">
                    <div class="module-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Modul Lanjutan">
                    </div>
                    <div class="module-content">
                        <h3>Modul Lanjutan</h3>
                        <p>Modul ini ditujukan untuk peserta yang ingin menguasai topik secara mendalam dan mengembangkan keahlian spesialis.</p>
                        <div class="module-objectives">
                            <h4>Tujuan Pembelajaran:</h4>
                            <ul>
                                <li>Menguasai konsep-konsep kompleks</li>
                                <li>Mengembangkan solusi inovatif</li>
                                <li>Menerapkan pengetahuan dalam proyek nyata</li>
                                <li>Mempersiapkan karir profesional</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="workflow-section">
        <div class="container">
            <div class="section-title">
                <h2>Alur Pembelajaran</h2>
                <p>Ikuti alur pembelajaran yang telah kami rancang untuk memastikan pengalaman belajar yang optimal</p>
            </div>

            <div class="workflow-container">
                <!-- Langkah 1 -->
                <div class="workflow-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Penilaian Awal</h3>
                        <p>Mulai dengan tes penilaian untuk mengukur tingkat pengetahuan Anda saat ini. Hasilnya akan membantu kami merekomendasikan modul yang paling sesuai dengan kebutuhan Anda.</p>
                    </div>
                    <div class="step-image">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Penilaian Awal">
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="workflow-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Pembelajaran Interaktif</h3>
                        <p>Ikuti sesi pembelajaran dengan materi yang disajikan secara interaktif, termasuk video, kuis, dan latihan langsung untuk memperkuat pemahaman.</p>
                    </div>
                    <div class="step-image">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Pembelajaran Interaktif">
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="workflow-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Praktik dan Aplikasi</h3>
                        <p>Terapkan pengetahuan yang telah dipelajari melalui proyek praktis dan studi kasus yang dirancang untuk mensimulasikan situasi dunia nyata.</p>
                    </div>
                    <div class="step-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Praktik dan Aplikasi">
                    </div>
                </div>

                <!-- Langkah 4 -->
                <div class="workflow-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Evaluasi dan Sertifikasi</h3>
                        <p>Ikuti ujian akhir untuk mengukur pencapaian pembelajaran Anda. Setelah lulus, Anda akan menerima sertifikat yang mengakui keterampilan baru Anda.</p>
                    </div>
                    <div class="step-image">
                        <img src="https://images.unsplash.com/photo-1561089489-f13d5e730d72?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Evaluasi dan Sertifikasi">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2023 Platform Pembelajaran. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script>
        // Controller JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Element references
            const viewAllBtn = document.getElementById('view-all');
            const viewBasicBtn = document.getElementById('view-basic');
            const viewIntermediateBtn = document.getElementById('view-intermediate');
            const viewAdvancedBtn = document.getElementById('view-advanced');
            const cardSizeSlider = document.getElementById('card-size-slider');
            const cardSizeDisplay = document.getElementById('card-size-display');
            const cardSizeValue = document.getElementById('card-size-value');
            const colorOptions = document.querySelectorAll('.color-option');
            const darkModeToggle = document.getElementById('dark-mode-toggle');
            const moduleCards = document.querySelectorAll('.module-card');
            const moduleContainer = document.getElementById('modules-container');

            // Filter modules by category
            function filterModules(category) {
                moduleCards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update active button
                document.querySelectorAll('.controller-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                event.target.classList.add('active');
            }

            // Adjust card size
            function adjustCardSize(value) {
                cardSizeDisplay.textContent = value;

                let sizeClass = '';
                if (value == 1) {
                    sizeClass = 'small';
                    cardSizeValue.textContent = 'Kecil';
                } else if (value == 2) {
                    sizeClass = 'medium';
                    cardSizeValue.textContent = 'Sedang';
                } else {
                    sizeClass = 'large';
                    cardSizeValue.textContent = 'Besar';
                }

                // Remove existing size classes
                moduleContainer.classList.remove('small', 'medium', 'large');
                // Add new size class
                moduleContainer.classList.add(sizeClass);

                // Apply CSS for different sizes
                const style = document.createElement('style');
                style.id = 'card-size-styles';
                if (document.getElementById('card-size-styles')) {
                    document.getElementById('card-size-styles').remove();
                }

                let css = '';
                if (value == 1) {
                    css = `
                        .modules-container.small {
                            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                        }
                        .modules-container.small .module-card {
                            transform: scale(0.9);
                        }
                    `;
                } else if (value == 3) {
                    css = `
                        .modules-container.large {
                            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                        }
                        .modules-container.large .module-content {
                            padding: 30px;
                        }
                    `;
                }

                style.innerHTML = css;
                document.head.appendChild(style);
            }

            // Change theme color
            function changeThemeColor(color) {
                document.documentElement.style.setProperty('--primary-color', color);

                // Update active color option
                colorOptions.forEach(option => {
                    option.classList.remove('active');
                });
                event.target.classList.add('active');
            }

            // Toggle dark mode
            function toggleDarkMode() {
                document.body.classList.toggle('dark-mode');

                // Add dark mode styles if needed
                if (document.body.classList.contains('dark-mode')) {
                    const darkModeStyles = `
                        <style id="dark-mode-styles">
                            body.dark-mode {
                                background-color: #1a1a1a;
                                color: #f0f0f0;
                            }
                            body.dark-mode .module-card,
                            body.dark-mode .workflow-step,
                            body.dark-mode .controller-panel {
                                background-color: #2d2d2d;
                                color: #f0f0f0;
                            }
                            body.dark-mode .module-content h3,
                            body.dark-mode .step-content h3,
                            body.dark-mode .section-title h2 {
                                color: #f0f0f0;
                            }
                            body.dark-mode .module-content p,
                            body.dark-mode .step-content p,
                            body.dark-mode .section-title p {
                                color: #cccccc;
                            }
                            body.dark-mode .workflow-section {
                                background-color: #222222;
                            }
                        </style>
                    `;
                    if (!document.getElementById('dark-mode-styles')) {
                        document.head.insertAdjacentHTML('beforeend', darkModeStyles);
                    }
                } else {
                    const darkModeStyles = document.getElementById('dark-mode-styles');
                    if (darkModeStyles) {
                        darkModeStyles.remove();
                    }
                }
            }

            // Event listeners
            viewAllBtn.addEventListener('click', () => filterModules('all'));
            viewBasicBtn.addEventListener('click', () => filterModules('basic'));
            viewIntermediateBtn.addEventListener('click', () => filterModules('intermediate'));
            viewAdvancedBtn.addEventListener('click', () => filterModules('advanced'));

            cardSizeSlider.addEventListener('input', () => {
                adjustCardSize(cardSizeSlider.value);
            });

            colorOptions.forEach(option => {
                option.addEventListener('click', () => {
                    changeThemeColor(option.dataset.color);
                });
            });

            darkModeToggle.addEventListener('change', toggleDarkMode);

            // Initialize
            adjustCardSize(cardSizeSlider.value);

            // Add CSS variable for primary color
            document.documentElement.style.setProperty('--primary-color', '#3498db');
        });
    </script>
</body>
</html>
