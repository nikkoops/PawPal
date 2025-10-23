<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAWPAL Adoption Application - Acknowledgment & Agreement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background:#f8fafc;">
<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="text-center mb-3" style="font-size:2rem;">
                🐾 PAWPAL Adoption Application
                @if(!empty($petName))<br><span class="fw-bold">for {{ $petName }}</span>@endif
            </h2>
            <h4 class="text-center mb-4">Acknowledgment & Agreement</h4>
            <p class="mb-4 text-center">Welcome to PAWPAL!<br>Before proceeding with your adoption application, please review the terms and conditions below. Your consent ensures transparency and mutual understanding throughout the adoption process.</p>
            <hr>
            <h5 class="mt-4">📜 Privacy & Data Policy</h5>
            <p>By continuing, you consent to the collection and processing of your personal information—including your contact details, living situation, and pet ownership history—for the purpose of evaluating your suitability as an adopter.<br>PAWPAL and its partner shelters will not share or sell your data to third parties without your consent, except as required by law.</p>
            <h5 class="mt-4">🏠 Adoption Responsibility</h5>
            <ul>
                <li>You understand that adopting a pet is a lifelong commitment involving care, time, and financial responsibility.</li>
                <li>You agree to provide proper food, shelter, medical care, and affection to your adopted pet.</li>
                <li>If you are no longer able to care for your pet, you will notify PAWPAL or the partner shelter rather than abandon or transfer the animal without permission.</li>
            </ul>
            <h5 class="mt-4">⚖️ Shelter Rights</h5>
            <ul>
                <li>PAWPAL and its partner shelters reserve the right to approve or decline applications based on their evaluation.</li>
                <li>Conduct home or background checks if deemed necessary.</li>
                <li>Reclaim an adopted pet if evidence of neglect, abuse, or policy violation arises.</li>
            </ul>
            <h5 class="mt-4">💬 Confirmation</h5>
            <ul>
                <li>You have read, understood, and agree to all terms and policies above.</li>
                <li>All information you provide in the next sections will be true and accurate to the best of your knowledge.</li>
            </ul>
            <form method="GET" action="{{ route('adoption.application') }}">
                <input type="hidden" name="pet" value="{{ request('pet') }}">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                    <label class="form-check-label" for="agree">
                        I have read and agree to the terms and conditions stated above.
                    </label>
                </div>
                <button type="submit" class="btn btn-warning w-100" style="background-color:#fe7701; color:white;">
                    ➡️ Continue to Application
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
