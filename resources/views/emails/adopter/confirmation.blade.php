@component('mail::message')
# Hello {{ $name }},

Thank you for submitting your adoption request to **PawPal**! 🐾  
We’ve received your details and our team will review your application soon.

You’ll hear back from us shortly.
 
Below is a copy of the information you submitted — please keep this for your records:


@if(!empty($answers) && is_array($answers))
    @php
        // fields to treat as pet details (keeps order)
        $petFields = ['pet_type', 'pet_breed', 'pet_name'];
        // fields to ignore in the email (internal ids, uploaded files, etc.)
        $ignore = ['pet_id', 'homePhotos', 'idUpload', '_token'];

        // helper to prettify keys
        $prettyKey = function ($key) {
            return ucwords(str_replace(['_', '-'], ' ', preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $key)));
        };

        // normalize a value for display
        $displayValue = function ($value) {
            if (is_array($value)) {
                return implode(', ', $value);
            }
            return (string) $value;
        };

        // Compose preferred time string if all parts exist
        $hasTime = isset($answers['interviewHour'], $answers['interviewMinute'], $answers['interviewPeriod']);
        $preferredTime = $hasTime ? (ltrim($answers['interviewHour'], '0') . ':' . str_pad($answers['interviewMinute'], 2, '0', STR_PAD_LEFT) . ' ' . $answers['interviewPeriod']) : null;
    @endphp

{{-- Interview Time Section --}}
@component('mail::panel')
**Interview Date:** {{ $answers['interviewDate'] ?? 'Not provided' }}  
**Interview Time:** {{ $preferredTime ?? 'Not provided' }}
@endcomponent


{{-- Pet details table (no pet_id) --}}
@component('mail::panel')
<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;">
    <tr>
        <td style="padding:6px 0; font-size:16px; font-weight:600;">Pet details</td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;">
                @foreach($petFields as $key)
                    @if(array_key_exists($key, $answers) && !in_array($key, $ignore))
                        <tr>
                            <td style="width:35%; padding:6px 0; vertical-align:top; font-weight:600;">{{ $prettyKey($key) }}</td>
                            <td style="padding:6px 0; vertical-align:top;">{{ $displayValue($answers[$key]) }}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </td>
    </tr>
</table>
@endcomponent


{{-- Applicant details table --}}
@component('mail::panel')
<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;">
    <tr>
        <td style="padding:6px 0; font-size:16px; font-weight:600;">Your application</td>
    </tr>
    <tr>
        <td>
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;">
                @php
                    // Compose preferred time string if all parts exist
                    $hasTime = isset($answers['interviewHour'], $answers['interviewMinute'], $answers['interviewPeriod']);
                    $preferredTime = $hasTime ? (ltrim($answers['interviewHour'], '0') . ':' . str_pad($answers['interviewMinute'], 2, '0', STR_PAD_LEFT) . ' ' . $answers['interviewPeriod']) : null;
                @endphp
                @foreach($answers as $key => $value)
                    @continue(in_array($key, $ignore) || in_array($key, $petFields) || in_array($key, ['interviewHour','interviewMinute','interviewPeriod']))
                    <tr>
                        <td style="width:35%; padding:6px 0; vertical-align:top; font-weight:600;">{{ $prettyKey($key) }}</td>
                        <td style="padding:6px 0; vertical-align:top;">
                            @if($key === 'interviewDate' && $preferredTime)
                                {{ $displayValue($value) }}<br><span style="font-size:13px; color:#666;">Preferred time: {{ $preferredTime }}</span>
                            @else
                                {{ $displayValue($value) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
@endcomponent
@else
We couldn't include your form details in this email.
@endif

Thanks,<br>
**The PawPal Team**
@endcomponent
