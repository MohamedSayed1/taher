<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Het kenmerk :moet worden aanvaard.',
    'accepted_if' => 'Het kenmerk :moet worden geaccepteerd wanneer :other :value is.',
    'active_url' => 'Het kenmerk :is geen geldige URL.',
    'after' => 'Het kenmerk :moet een datum na of gelijk aan :date zijn,',
    'after_or_equal' => 'Het kenmerk :moet een datum na of gelijk aan datum zijn',
    'alpha' => 'Het kenmerk: mag alleen letters bevatten.',
    'alpha_dash' => 'Het kenmerk :mag alleen letters, cijfers, streepjes en onderstrepingstekens bevatten.',
    'alpha_num' => 'Het attribuut :mag alleen letters en cijfers bevatten.',
    'array' => 'Het kenmerk :moet een reeks zijn.',
    'before' => 'Het kenmerk :moet een datum vóór :datum.',
    'before_or_equal' => 'Het kenmerk :moet een datum vóór of gelijk aan :d ate.',
    'between' => [
        'numeric' => 'Het kenmerk: moet tussen :min en :max.',
        'file' => 'Het kenmerk :moet tussen :min en :max kilobytes liggen',
        'string' => 'Het kenmerk :moet tussen de tekens :min en :max liggen',
        'array' => 'Het kenmerk :moet tussen :min en :max items hebben.',
    ],
    'boolean' => 'Het kenmerk: moet waar of onwaar zijn.',
    'confirmed' => 'Het kenmerk: bevestiging komt niet overeen.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Het kenmerk: geen geldige datum is.',
    'date_equals' => 'Het kenmerk:  moet een datum zijn die gelijk is aan :date.',
    'date_format' => 'Het kenmerk :komt niet overeen met het formaat :format.',
    'declined' => 'Het kenmerk :moet worden geweigerd.',
    'declined_if' => 'Het kenmerk :moet worden geweigerd wanneer :other :value is.',
    'different' => 'Het kenmerk: andere moeten anders zijn.',
    'digits' => 'Het kenmerk :moet cijfers.',
    'digits_between' => 'Het kenmerk :moet tussen min en max digits liggen.',
    'dimensions' => 'Het kenmerk :heeft ongeldige afbeeldingsafmetingen.',
    'distinct' => 'Het kenmerk :heeft een dubbele waarde.',
    'email' => 'Het kenmerk :moet een geldig e-mailadres zijn.',
    'ends_with' => 'Het kenmerk: moet eindigen op een van de volgende waarden.',
    'enum' => 'Het geselecteerde kenmerk is ongeldig.',
    'exists' => 'Het geselecteerde kenmerk is ongeldig.',
    'file' => 'Het kenmerk :moet een bestand zijn.',
    'filled' => 'Het kenmerk moet een waarde hebben.',
    'gt' => [
        'numeric' => 'Het kenmerk :moet groter zijn dan de waarde.',
        'file' => 'Het kenmerk :moet groter zijn dan de waarde kilobytes.',
        'string' => 'Het kenmerk :moet groter zijn dan waardetekens.',
        'array' => 'Het kenmerk :moet meer dan waarde-items bevatten.',
    ],
    'gte' => [
        'numeric' => 'Het kenmerk :moet groter zijn dan of gelijk zijn aan de waarde.',
        'file' => 'Het kenmerk :moet groter zijn dan of gelijk zijn aan de waarde kilobytes.',
        'string' => 'Het kenmerk :moet groter zijn dan of gelijk zijn aan waardetekens.',
        'array' => 'Het kenmerk :moet waarde-items of meer bevatten.',
    ],
    'image' => 'Het kenmerk :moet een afbeelding zijn.',
    'in' => 'Het geselecteerde kenmerk is ongeldig.',
    'in_array' => 'Het attribuutveld bestaat niet in andere.',
    'integer' => 'Het kenmerk :moet een geheel getal zijn.',
    'ip' => 'Het kenmerk :moet een geldig IP-adres zijn.',
    'ipv4' => 'Het kenmerk :moet een geldig IPv4-adres zijn.',
    'ipv6' => 'Het kenmerk :moet een geldig IPv6-adres zijn.',
    'json' => 'Het kenmerk :moet een geldige JSON-tekenreeks zijn.',
    'lt' => [
        'numeric' => 'Het kenmerk :moet kleiner zijn dan de waarde.',
        'file' => 'Het kenmerk :moet kleiner zijn dan de waarde kilobytes.',
        'string' => 'Het kenmerk :moet kleiner zijn dan de waardetekens.',
        'array' => 'Het kenmerk :moet items met minder dan waarde hebben.',
    ],
    'lte' => [
        'numeric' => 'Het kenmerk :moet kleiner zijn dan of gelijk zijn aan de waarde.',
        'file' => 'Het kenmerk :moet kleiner zijn dan of gelijk zijn aan de waarde kilobytes.',
        'string' => 'Het kenmerk :moet kleiner zijn dan of gelijk zijn aan waardetekens.',
        'array' => 'Het kenmerk :mag niet meer dan waarde-items bevatten.',
    ],
    'mac_address' => 'Het kenmerk :moet een geldig MAC-adres zijn.',
    'max' => [
        'numeric' => 'Het kenmerk :mag niet groter zijn dan max.',
        'file' => 'Het kenmerk :mag niet groter zijn dan het maximum van kilobytes.',
        'string' => 'Het kenmerk :mag niet groter zijn dan het maximumteken.',
        'array' => 'Het kenmerk :mag niet meer dan het maximumaantal items bevatten.',
    ],
    'mimes' => 'Het kenmerk :moet een bestand met typewaarden zijn.',
    'mimetypes' => 'Het kenmerk :moet een bestand met typewaarden zijn.',
    'min' => [
        'numeric' => 'Het kenmerk:moet ten minste min. zijn.',
        'file' => 'Het kenmerk :moet ten minste min kilobytes zijn.',
        'string' => 'Het kenmerk :moet ten minste min tekens bevatten.',
        'array' => 'Het kenmerk :moet ten minste min items bevatten.',
    ],
    'multiple_of' => 'Het kenmerk :moet een veelvoud van waarde zijn.',
    'not_in' => 'Het geselecteerde kenmerk is ongeldig.',
    'not_regex' => 'De indeling :attribuut is ongeldig.',
    'numeric' => 'Het kenmerk :moet een getal zijn.',
    'password' => 'The password is incorrect.',
    'present' => 'Het attribuutveld moet aanwezig zijn.',
    'prohibited' => 'Het attribuutveld is verboden.',
    'prohibited_if' => 'Het attribuutveld is verboden wanneer een andere waarde is.',
    'prohibited_unless' => 'Het attribuutveld is verboden, tenzij andere in waarden is vermeld.',
    'prohibits' => 'Het attribuutveld verbiedt anderen om aanwezig te zijn.',
    'regex' => 'De indeling :attribuut is ongeldig.',
    'required' => 'Het attribuutveld is verplicht',
    'required_array_keys' => 'Het attribuutveld moet vermeldingen voor waarden bevatten.',
    'required_if' => 'Het attribuutveld is vereist wanneer andere waarde is.',
    'required_unless' => 'Het attribuutveld is verplicht, tenzij andere in waarden is vermeld.',
    'required_with' => 'Het attribuutveld :is vereist wanneer waarden aanwezig zijn.',
    'required_with_all' => 'Het kenmerk :attribuut is vereist wanneer er waarden aanwezig zijn.',
    'required_without' => 'Het kenmerk :attribuut is vereist wanneer er geen waarden aanwezig zijn.',
    'required_without_all' => 'Het kenmerk :attribuut is vereist wanneer er geen waarden aanwezig zijn.',
    'same' => 'Het kenmerk en andere moeten overeenkomen.',
    'size' => [
        'numeric' => 'Het kenmerk :moet maat zijn.',
        'file' => 'Het kenmerk :moet size kilobytes.',
        'string' => 'Het kenmerk :moet bestaan uit size characters.',
        'array' => 'Het kenmerk : moet size items bevatten.',
    ],
    'starts_with' => 'Het kenmerk: moet beginnen met een van de volgende: :waarden.',
    'string' => 'Het kenmerk :moet een tekenreeks zijn.',
    'timezone' => 'Het kenmerk :moet een geldige tijdzone zijn.',
    'unique' => 'Het kenmerk: reeds is ingenomen.',
    'uploaded' => 'Het kenmerk :kan niet worden geüpload.',
    'url' => 'Het kenmerk: moet een geldige URL zijn.',
    'uuid' => 'Het kenmerk :moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'email' => [
            'unique' => 'De waarde van het e-mailveld is al in gebruik. Klik alstublieft op de rode knop (Inloggen) hieronder.',

        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
