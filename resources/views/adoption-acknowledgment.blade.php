<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWPAL Adoption Application - Acknowledgment & Agreement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #fff5eb 0%, #ffe8d6 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Paw prints background pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(254, 119, 1, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(254, 119, 1, 0.03) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
        }

        .paw-print {
            position: fixed;
            font-size: 2rem;
            opacity: 0.05;
            color: #fe7701;
            z-index: 0;
            pointer-events: none;
            animation: float 20s infinite ease-in-out;
        }

        .paw-1 { top: 10%; left: 10%; animation-delay: 0s; }
        .paw-2 { top: 20%; right: 15%; animation-delay: 2s; }
        .paw-3 { top: 40%; left: 5%; animation-delay: 4s; }
        .paw-4 { top: 60%; right: 10%; animation-delay: 6s; }
        .paw-5 { top: 80%; left: 20%; animation-delay: 8s; }
        .paw-6 { bottom: 10%; right: 20%; animation-delay: 10s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '🐾';
            position: absolute;
            font-size: 8rem;
            opacity: 0.1;
            top: -1rem;
            right: -1rem;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.05); opacity: 0.15; }
        }

        .card-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .card-header .pet-name {
            font-size: 2rem;
            font-weight: 800;
            margin: 0.5rem 0;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 500;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 2.5rem 2rem;
        }

        .welcome-text {
            text-align: center;
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 12px;
            border-left: 4px solid #fe7701;
            transition: all 0.3s ease;
        }

        .section:hover {
            background: #fff;
            box-shadow: 0 4px 12px rgba(254, 119, 1, 0.1);
            transform: translateX(4px);
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title .icon {
            font-size: 1.5rem;
        }

        .section-content {
            color: #4b5563;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .section-content ul {
            list-style: none;
            padding-left: 0;
            margin: 0.75rem 0 0 0;
        }

        .section-content ul li {
            padding: 0.5rem 0;
            padding-left: 1.5rem;
            position: relative;
        }

        .section-content ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #fe7701;
            font-weight: bold;
        }

        .checkbox-container {
            background: #fffbf6;
            border: 2px solid #fed7aa;
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0 1.5rem 0;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .checkbox-container:hover {
            border-color: #fe7701;
            background: #fff;
        }

        .checkbox-container input[type="checkbox"] {
            width: 24px;
            height: 24px;
            cursor: pointer;
            accent-color: #fe7701;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .checkbox-container label {
            font-size: 1rem;
            color: #1f2937;
            cursor: pointer;
            font-weight: 500;
            line-height: 1.6;
        }

        .submit-button {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(254, 119, 1, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(254, 119, 1, 0.4);
            background: linear-gradient(135deg, #ff9534 0%, #fe7701 100%);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .card-header {
                padding: 2rem 1.5rem;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }

            .card-header .pet-name {
                font-size: 1.75rem;
            }

            .card-body {
                padding: 1.5rem 1rem;
            }

            .section {
                padding: 1rem;
            }

            .paw-print {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating paw prints -->
    <div class="paw-print paw-1">🐾</div>
    <div class="paw-print paw-2">🐾</div>
    <div class="paw-print paw-3">🐾</div>
    <div class="paw-print paw-4">🐾</div>
    <div class="paw-print paw-5">🐾</div>
    <div class="paw-print paw-6">🐾</div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <button onclick="window.location.href='/'" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 28px; color: #fff; cursor: pointer; line-height: 1; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; opacity: 0.9; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.9'">&times;</button>
                <h1>🐾 PAWPAL Adoption Application</h1>
                @if(!empty($petName))
                    <div class="pet-name">for {{ $petName }}</div>
                @endif
                <h2>Acknowledgment & Agreement</h2>
            </div>

            <div class="card-body">
                <div class="welcome-text">
                    <strong>Welcome to PAWPAL!</strong><br>
                    Before proceeding with your adoption application, please review the terms and conditions below. 
                    Your consent ensures transparency and mutual understanding throughout the adoption process.
                </div>

                <div class="section">
                    <div class="section-title">
                        <span class="icon">📜</span>
                        <span>Privacy & Data Policy</span>
                    </div>
                    <div class="section-content">
                        By continuing, you consent to the collection and processing of your personal information—including your contact details, 
                        living situation, and pet ownership history—for the purpose of evaluating your suitability as an adopter.
                        <br><br>
                        PAWPAL and its partner shelters will not share or sell your data to third parties without your consent, except as required by law.
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">
                        <span class="icon">🏠</span>
                        <span>Adoption Responsibility</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>You understand that adopting a pet is a lifelong commitment involving care, time, and financial responsibility.</li>
                            <li>You agree to provide proper food, shelter, medical care, and affection to your adopted pet.</li>
                            <li>If you are no longer able to care for your pet, you will notify PAWPAL or the partner shelter rather than abandon or transfer the animal without permission.</li>
                        </ul>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">
                        <span class="icon">⚖️</span>
                        <span>Shelter Rights</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>PAWPAL and its partner shelters reserve the right to approve or decline applications based on their evaluation.</li>
                            <li>Conduct home or background checks if deemed necessary.</li>
                            <li>Reclaim an adopted pet if evidence of neglect, abuse, or policy violation arises.</li>
                        </ul>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">
                        <span class="icon">💬</span>
                        <span>Confirmation</span>
                    </div>
                    <div class="section-content">
                        <ul>
                            <li>You have read, understood, and agree to all terms and policies above.</li>
                            <li>All information you provide in the next sections will be true and accurate to the best of your knowledge.</li>
                        </ul>
                    </div>
                </div>

                <form method="GET" action="{{ route('adoption.application') }}" id="acknowledgmentForm">
                    <input type="hidden" name="pet" value="{{ request('pet') }}">
                    
                    <div class="checkbox-container">
                        <input type="checkbox" id="agree" name="agree" required>
                        <label for="agree">
                            I have read and agree to all the terms and conditions stated above.
                        </label>
                    </div>

                    <button type="submit" class="submit-button" id="submitBtn" disabled>
                        <span>Continue to Application</span>
                        <span>→</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Enable submit button only when checkbox is checked
        const checkbox = document.getElementById('agree');
        const submitBtn = document.getElementById('submitBtn');

        checkbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });

        // Add smooth scroll on page load
        window.addEventListener('load', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
