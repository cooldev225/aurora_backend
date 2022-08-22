<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Aurora API</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-3.36.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-3.36.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>
                                            
                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>
                                            
                                                </ul>
                    
                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="clinics">
                    <a href="#clinics">Clinics</a>
                </li>
                                    <ul id="tocify-subheader-clinics" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="clinics-POSTclinics">
                        <a href="#clinics-POSTclinics">[Clinic] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="clinics-PUTclinics--id-">
                        <a href="#clinics-PUTclinics--id-">[Clinic] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="clinics-DELETEclinics--id-">
                        <a href="#clinics-DELETEclinics--id-">[Clinic] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="clinics-GETclinics">
                        <a href="#clinics-GETclinics">[Clinic] - List</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTlogin">
                        <a href="#endpoints-POSTlogin">[Authentication] - User Login</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTverify_token">
                        <a href="#endpoints-POSTverify_token">[Authentication] - Verify Token</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTlogout">
                        <a href="#endpoints-POSTlogout">[Authentication] - User Logout</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTrefresh">
                        <a href="#endpoints-POSTrefresh">[Authentication] - Refresh Token</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETusers">
                        <a href="#endpoints-GETusers">[User] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTupdate-profile">
                        <a href="#endpoints-POSTupdate-profile">[User] - Update User Profile</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETprofile">
                        <a href="#endpoints-GETprofile">[User] - User Profile</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTchange-password">
                        <a href="#endpoints-POSTchange-password">[User] - Update Password</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointment_pre_admissions-show--token-">
                        <a href="#endpoints-GETappointment_pre_admissions-show--token-">[Pre Admission] - Show Initial Form</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointment_pre_admissions-validate--token-">
                        <a href="#endpoints-POSTappointment_pre_admissions-validate--token-">[Pre Admission] - Validate Pre Admission</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointment_pre_admissions-store--token-">
                        <a href="#endpoints-POSTappointment_pre_admissions-store--token-">[Pre Admission] - Create Pre Admission</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTmails-send">
                        <a href="#endpoints-POSTmails-send">[Mail] - Send</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTmails-send-draft">
                        <a href="#endpoints-POSTmails-send-draft">[Mail] - Send Draft Mail</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTmails-update-draft">
                        <a href="#endpoints-POSTmails-update-draft">[Mail] - Update Draft.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTmails-bookmark--id-">
                        <a href="#endpoints-PUTmails-bookmark--id-">[Mail] - Bookmark</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTmails-delete--id-">
                        <a href="#endpoints-PUTmails-delete--id-">[Mail] - Move to Trash</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTmails-restore--id-">
                        <a href="#endpoints-PUTmails-restore--id-">[Mail] - Restore from Trash</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETmails">
                        <a href="#endpoints-GETmails">[Mail] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTmails">
                        <a href="#endpoints-POSTmails">[Mail] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETmails--id-">
                        <a href="#endpoints-GETmails--id-">[Mail] - Show</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEmails--id-">
                        <a href="#endpoints-DELETEmails--id-">[Mail] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETadmins">
                        <a href="#endpoints-GETadmins">[Admin User] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTadmins">
                        <a href="#endpoints-POSTadmins">[Admin User] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTadmins--id-">
                        <a href="#endpoints-PUTadmins--id-">[Admin User] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEadmins--id-">
                        <a href="#endpoints-DELETEadmins--id-">[Admin User] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETuser-roles">
                        <a href="#endpoints-GETuser-roles">[User&#039;s Role] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTuser-roles">
                        <a href="#endpoints-POSTuser-roles">[User&#039;s Role] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTuser-roles--id-">
                        <a href="#endpoints-PUTuser-roles--id-">[User&#039;s Role] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEuser-roles--id-">
                        <a href="#endpoints-DELETEuser-roles--id-">[User&#039;s Role] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETorganizations">
                        <a href="#endpoints-GETorganizations">[Organization] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTorganizations">
                        <a href="#endpoints-POSTorganizations">[Organization] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTorganizations--id-">
                        <a href="#endpoints-PUTorganizations--id-">[Organization] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEorganizations--id-">
                        <a href="#endpoints-DELETEorganizations--id-">[Organization] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETbirth-codes">
                        <a href="#endpoints-GETbirth-codes">[Birth Code] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTbirth-codes">
                        <a href="#endpoints-POSTbirth-codes">[Birth Code] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTbirth-codes--id-">
                        <a href="#endpoints-PUTbirth-codes--id-">[Birth Code] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEbirth-codes--id-">
                        <a href="#endpoints-DELETEbirth-codes--id-">[Birth Code] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GEThealth-funds">
                        <a href="#endpoints-GEThealth-funds">[Health Fund] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSThealth-funds">
                        <a href="#endpoints-POSThealth-funds">[Health Fund] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUThealth-funds--id-">
                        <a href="#endpoints-PUThealth-funds--id-">[Health Fund] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEhealth-funds--id-">
                        <a href="#endpoints-DELETEhealth-funds--id-">[Health Fund] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETorganization-admins">
                        <a href="#endpoints-GETorganization-admins">[Organization Admin] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTorganization-admins">
                        <a href="#endpoints-POSTorganization-admins">[Organization Admin] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTorganization-admins--id-">
                        <a href="#endpoints-PUTorganization-admins--id-">[Organization Admin] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEorganization-admins--id-">
                        <a href="#endpoints-DELETEorganization-admins--id-">[Organization Admin] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETorganization-managers">
                        <a href="#endpoints-GETorganization-managers">[Organization Manager] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTorganization-managers">
                        <a href="#endpoints-POSTorganization-managers">[Organization Manager] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTorganization-managers--id-">
                        <a href="#endpoints-PUTorganization-managers--id-">[Organization Manager] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEorganization-managers--id-">
                        <a href="#endpoints-DELETEorganization-managers--id-">[Organization Manager] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETemail-templates">
                        <a href="#endpoints-GETemail-templates">[Email Template] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTemail-templates">
                        <a href="#endpoints-POSTemail-templates">[Email Template] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTemail-templates--id-">
                        <a href="#endpoints-PUTemail-templates--id-">[Email Template] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEemail-templates--id-">
                        <a href="#endpoints-DELETEemail-templates--id-">[Email Template] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointment-time-requirements">
                        <a href="#endpoints-GETappointment-time-requirements">[Appointment Time Requirement] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointment-time-requirements">
                        <a href="#endpoints-POSTappointment-time-requirements">[Appointment Time Requirement] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointment-time-requirements--id-">
                        <a href="#endpoints-PUTappointment-time-requirements--id-">[Appointment Time Requirement] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEappointment-time-requirements--id-">
                        <a href="#endpoints-DELETEappointment-time-requirements--id-">[Appointment Time Requirement] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointment-types">
                        <a href="#endpoints-GETappointment-types">[Appointment Type] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointment-types">
                        <a href="#endpoints-POSTappointment-types">[Appointment Type] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointment-types--id-">
                        <a href="#endpoints-PUTappointment-types--id-">[Appointment Type] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEappointment-types--id-">
                        <a href="#endpoints-DELETEappointment-types--id-">[Appointment Type] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETproda-devices">
                        <a href="#endpoints-GETproda-devices">[Proda Device] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTproda-devices">
                        <a href="#endpoints-POSTproda-devices">[Proda Device] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTproda-devices--id-">
                        <a href="#endpoints-PUTproda-devices--id-">[Proda Device] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEproda-devices--id-">
                        <a href="#endpoints-DELETEproda-devices--id-">[Proda Device] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETnotification-templates">
                        <a href="#endpoints-GETnotification-templates">[Notification Template] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTnotification-templates">
                        <a href="#endpoints-POSTnotification-templates">[Notification Template] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTnotification-templates--id-">
                        <a href="#endpoints-PUTnotification-templates--id-">[Notification Template] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEnotification-templates--id-">
                        <a href="#endpoints-DELETEnotification-templates--id-">[Notification Template] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETanesthetic-questions">
                        <a href="#endpoints-GETanesthetic-questions">[Anesthetic Question] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTanesthetic-questions">
                        <a href="#endpoints-POSTanesthetic-questions">[Anesthetic Question] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTanesthetic-questions--id-">
                        <a href="#endpoints-PUTanesthetic-questions--id-">[Anesthetic Question] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEanesthetic-questions--id-">
                        <a href="#endpoints-DELETEanesthetic-questions--id-">[Anesthetic Question] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointments--appointment_id--questions--question_id--anesthetic-answers">
                        <a href="#endpoints-GETappointments--appointment_id--questions--question_id--anesthetic-answers">[Anesthetic Answer] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointments--appointment_id--questions--question_id--anesthetic-answers">
                        <a href="#endpoints-POSTappointments--appointment_id--questions--question_id--anesthetic-answers">[Anesthetic Answer] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
                        <a href="#endpoints-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-">[Anesthetic Answer] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
                        <a href="#endpoints-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-">[Anesthetic Answer] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETemployees">
                        <a href="#endpoints-GETemployees">[Employee] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTemployees">
                        <a href="#endpoints-POSTemployees">[Employee] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTemployees--id-">
                        <a href="#endpoints-PUTemployees--id-">[Employee] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEemployees--id-">
                        <a href="#endpoints-DELETEemployees--id-">[Employee] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETspecialists">
                        <a href="#endpoints-GETspecialists">[Specialist] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTspecialists">
                        <a href="#endpoints-POSTspecialists">[Specialist] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTspecialists--id-">
                        <a href="#endpoints-PUTspecialists--id-">[Specialist] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEspecialists--id-">
                        <a href="#endpoints-DELETEspecialists--id-">[Specialist] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETemployee-roles">
                        <a href="#endpoints-GETemployee-roles">[User&#039;s Role] - Employee Role List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpatient-recalls">
                        <a href="#endpoints-GETpatient-recalls">[Patient Recall] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-recalls">
                        <a href="#endpoints-POSTpatient-recalls">[Patient Recall] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatient-recalls--id-">
                        <a href="#endpoints-PUTpatient-recalls--id-">[Patient Recall] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatient-recalls--id-">
                        <a href="#endpoints-DELETEpatient-recalls--id-">[Patient Recall] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETreport-templates">
                        <a href="#endpoints-GETreport-templates">[Report Template] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTreport-templates">
                        <a href="#endpoints-POSTreport-templates">[Report Template] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTreport-templates--id-">
                        <a href="#endpoints-PUTreport-templates--id-">[Report Template] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEreport-templates--id-">
                        <a href="#endpoints-DELETEreport-templates--id-">[Report Template] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpre-admission-sections">
                        <a href="#endpoints-GETpre-admission-sections">[Pre Admission] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpre-admission-sections">
                        <a href="#endpoints-POSTpre-admission-sections">[Pre Admission] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpre-admission-sections--id-">
                        <a href="#endpoints-PUTpre-admission-sections--id-">[Pre Admission] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpre-admission-sections--id-">
                        <a href="#endpoints-DELETEpre-admission-sections--id-">[Pre Admission] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTupdate-pre-admission-consent">
                        <a href="#endpoints-POSTupdate-pre-admission-consent">[Pre Admission] - Update Consent</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETget-pre-admission-consent">
                        <a href="#endpoints-GETget-pre-admission-consent">[Pre Admission] - Get Consent</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTnotification-test">
                        <a href="#endpoints-POSTnotification-test">[Organization] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpayments">
                        <a href="#endpoints-GETpayments">[Payment] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpayments--appointment_id-">
                        <a href="#endpoints-GETpayments--appointment_id-">[Payment] - Show</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpayments">
                        <a href="#endpoints-POSTpayments">[Payment] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETclinics--clinic_id--rooms">
                        <a href="#endpoints-GETclinics--clinic_id--rooms">[Room] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTclinics--clinic_id--rooms">
                        <a href="#endpoints-POSTclinics--clinic_id--rooms">[Room] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTclinics--clinic_id--rooms--id-">
                        <a href="#endpoints-PUTclinics--clinic_id--rooms--id-">[Room] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEclinics--clinic_id--rooms--id-">
                        <a href="#endpoints-DELETEclinics--clinic_id--rooms--id-">[Room] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointments">
                        <a href="#endpoints-GETappointments">Display a listing of the resource.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTappointments">
                        <a href="#endpoints-POSTappointments">Store a newly created resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointments--id-">
                        <a href="#endpoints-GETappointments--id-">GET appointments/{id}</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments--id-">
                        <a href="#endpoints-PUTappointments--id-">Update the specified resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEappointments--id-">
                        <a href="#endpoints-DELETEappointments--id-">Remove the specified resource from storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETreferring-doctors">
                        <a href="#endpoints-GETreferring-doctors">[Referring Doctor] - All</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTreferring-doctors">
                        <a href="#endpoints-POSTreferring-doctors">[Referring Doctor] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTreferring-doctors--id-">
                        <a href="#endpoints-PUTreferring-doctors--id-">[Referring Doctor] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEreferring-doctors--id-">
                        <a href="#endpoints-DELETEreferring-doctors--id-">[Referring Doctor] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETuser-appointments">
                        <a href="#endpoints-GETuser-appointments">[User Appointment] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-update_collecting_person--id-">
                        <a href="#endpoints-PUTappointments-update_collecting_person--id-">Procedure Approve by Anesthetist</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-procedureApprovalStatus--appointment_id-">
                        <a href="#endpoints-PUTappointments-procedureApprovalStatus--appointment_id-">[Appointment Procedure Approval] - Update Status</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-check-in--appointment_id-">
                        <a href="#endpoints-PUTappointments-check-in--appointment_id-">Check In</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-check-out--appointment_id-">
                        <a href="#endpoints-PUTappointments-check-out--appointment_id-">Check Out</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-cancel--appointment_id-">
                        <a href="#endpoints-PUTappointments-cancel--appointment_id-">Cancel Appointment</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-wait-listed--appointment-">
                        <a href="#endpoints-PUTappointments-wait-listed--appointment-">Appointment wait listed</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointment-referrals-update--appointment-">
                        <a href="#endpoints-PUTappointment-referrals-update--appointment-">[Organization] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETavailable-slots">
                        <a href="#endpoints-GETavailable-slots">Return available time slots</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETwork-hours">
                        <a href="#endpoints-GETwork-hours">[Specialist] - Work Hours By Today</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETwork-hours-by-week">
                        <a href="#endpoints-GETwork-hours-by-week">[Specialist] - Work Hours By Week</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETanesthetists">
                        <a href="#endpoints-GETanesthetists">[Anesthetist] - List.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents">
                        <a href="#endpoints-POSTpatient-documents">[Patient Document] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents-upload">
                        <a href="#endpoints-POSTpatient-documents-upload">[Patient Document] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents-letter">
                        <a href="#endpoints-POSTpatient-documents-letter">[Patient Document Letter] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatient-documents-letter--id-">
                        <a href="#endpoints-PUTpatient-documents-letter--id-">[Patient Document Letter] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatient-documents-letter--id-">
                        <a href="#endpoints-DELETEpatient-documents-letter--id-">[Patient Document Letter] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-document--patient_id--letter-upload">
                        <a href="#endpoints-POSTpatient-document--patient_id--letter-upload">[Patient Document Letter] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents-report">
                        <a href="#endpoints-POSTpatient-documents-report">[Patient Document Report] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatient-documents-report--id-">
                        <a href="#endpoints-PUTpatient-documents-report--id-">[Patient Document Report] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatient-documents-report--id-">
                        <a href="#endpoints-DELETEpatient-documents-report--id-">[Patient Document Report] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-document--patient_id--report-upload">
                        <a href="#endpoints-POSTpatient-document--patient_id--report-upload">[Patient Document Report] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents-clinical-note">
                        <a href="#endpoints-POSTpatient-documents-clinical-note">[Patient Document Clinical Note] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatient-documents-clinical-note--id-">
                        <a href="#endpoints-PUTpatient-documents-clinical-note--id-">[Patient Document Clinical Note] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatient-documents-clinical-note--id-">
                        <a href="#endpoints-DELETEpatient-documents-clinical-note--id-">[Patient Document Clinical Note] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-document--patient_id--clinical-note-upload">
                        <a href="#endpoints-POSTpatient-document--patient_id--clinical-note-upload">[Patient Document Clinical Note] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-documents-audio">
                        <a href="#endpoints-POSTpatient-documents-audio">[Patient Document Audio] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatient-documents-audio--id-">
                        <a href="#endpoints-PUTpatient-documents-audio--id-">[Patient Document Audio] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatient-documents-audio--id-">
                        <a href="#endpoints-DELETEpatient-documents-audio--id-">[Patient Document Audio] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-document--patient_id--audio-upload">
                        <a href="#endpoints-POSTpatient-document--patient_id--audio-upload">[Patient Document Audio] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpatient-document--patient_id--other-upload">
                        <a href="#endpoints-POSTpatient-document--patient_id--other-upload">[Patient Document Other] - Upload</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTpre-admission--appointment_id--upload">
                        <a href="#endpoints-POSTpre-admission--appointment_id--upload">[Pre Admission] - Upload Pre Admission</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpatients">
                        <a href="#endpoints-GETpatients">[Patient] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpatients--id-">
                        <a href="#endpoints-GETpatients--id-">[Patient] - Show</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTpatients--id-">
                        <a href="#endpoints-PUTpatients--id-">[Patient] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEpatients--id-">
                        <a href="#endpoints-DELETEpatients--id-">[Patient] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETpatients-appointments--patient_id-">
                        <a href="#endpoints-GETpatients-appointments--patient_id-">[Patient] - Appointment List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETletter-templates">
                        <a href="#endpoints-GETletter-templates">[Letter Template] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTletter-templates">
                        <a href="#endpoints-POSTletter-templates">[Letter Template] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTletter-templates--id-">
                        <a href="#endpoints-PUTletter-templates--id-">[Letter Template] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEletter-templates--id-">
                        <a href="#endpoints-DELETEletter-templates--id-">[Letter Template] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETprocedure-approvals">
                        <a href="#endpoints-GETprocedure-approvals">[Appointment Procedure Approval] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointment--appointment_id--procedure-approvals">
                        <a href="#endpoints-PUTappointment--appointment_id--procedure-approvals">[Appointment Procedure Approval] - Update Status</a>
                    </li>
                                                    </ul>
                            </ul>
        
                        
            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 22 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Backend API for Aurora System</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>Authenticate requests to this API's endpoints by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="clinics">Clinics</h1>

    

            <h2 id="clinics-POSTclinics">[Clinic] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTclinics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/clinics" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Frankston Practice\",
    \"email\": \"\",
    \"phone_number\": \"\",
    \"address\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Frankston Practice",
    "email": "",
    "phone_number": "",
    "address": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTclinics">
</span>
<span id="execution-results-POSTclinics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTclinics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTclinics"></code></pre>
</span>
<span id="execution-error-POSTclinics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTclinics"></code></pre>
</span>
<form id="form-POSTclinics" data-method="POST"
      data-path="clinics"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTclinics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTclinics"
                    onclick="tryItOut('POSTclinics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTclinics"
                    onclick="cancelTryOut('POSTclinics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTclinics" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>clinics</code></b>
        </p>
                <p>
            <label id="auth-POSTclinics" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTclinics"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTclinics"
               value="Frankston Practice"
               data-component="body" hidden>
    <br>
<p>The name of the clinic.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone_number"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="fax_number"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>hospital_provider_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="hospital_provider_number"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>VAED_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="VAED_number"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>document_letter_header</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="document_letter_header"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>document_letter_footer</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="document_letter_footer"
               data-endpoint="POSTclinics"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="clinics-PUTclinics--id-">[Clinic] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTclinics--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/clinics/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Frankston Practice\",
    \"email\": \"\",
    \"phone_number\": \"\",
    \"address\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Frankston Practice",
    "email": "",
    "phone_number": "",
    "address": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTclinics--id-">
</span>
<span id="execution-results-PUTclinics--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTclinics--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTclinics--id-"></code></pre>
</span>
<span id="execution-error-PUTclinics--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTclinics--id-"></code></pre>
</span>
<form id="form-PUTclinics--id-" data-method="PUT"
      data-path="clinics/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTclinics--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTclinics--id-"
                    onclick="tryItOut('PUTclinics--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTclinics--id-"
                    onclick="cancelTryOut('PUTclinics--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTclinics--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>clinics/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>clinics/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTclinics--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTclinics--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTclinics--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTclinics--id-"
               value="Frankston Practice"
               data-component="body" hidden>
    <br>
<p>The name of the clinic.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone_number"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="fax_number"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>hospital_provider_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="hospital_provider_number"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>VAED_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="VAED_number"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>document_letter_header</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="document_letter_header"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>document_letter_footer</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="document_letter_footer"
               data-endpoint="PUTclinics--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="clinics-DELETEclinics--id-">[Clinic] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEclinics--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/clinics/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEclinics--id-">
</span>
<span id="execution-results-DELETEclinics--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEclinics--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEclinics--id-"></code></pre>
</span>
<span id="execution-error-DELETEclinics--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEclinics--id-"></code></pre>
</span>
<form id="form-DELETEclinics--id-" data-method="DELETE"
      data-path="clinics/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEclinics--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEclinics--id-"
                    onclick="tryItOut('DELETEclinics--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEclinics--id-"
                    onclick="cancelTryOut('DELETEclinics--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEclinics--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>clinics/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEclinics--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEclinics--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEclinics--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                    </form>

            <h2 id="clinics-GETclinics">[Clinic] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>List all clinics thats are a part of the organization of the currently logged in user</p>

<span id="example-requests-GETclinics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/clinics" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETclinics">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">[
    {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Wayside Clinic&quot;,
        &quot;email&quot;: &quot;recpetion@wayside.com.au&quot;,
        &quot;phone_number&quot;: &quot;03-2435-2342&quot;,
        &quot;fax_number&quot;: &quot;03-2435-2335&quot;,
        &quot;hospital_provider_number&quot;: &quot;AU2344&quot;,
        &quot;VAED_number&quot;: &quot;214124&quot;,
        &quot;Address&quot;: &quot;106 Broad rd, VIC, 3500&quot;,
        &quot;document_letter_header&quot;: &quot;filename&quot;,
        &quot;document_letter_footer&quot;: &quot;filename&quot;,
        &quot;created_at&quot;: &quot;2022-08-22 12:30:54&quot;,
        &quot;updated_at&quot;: &quot;2022-08-25 14:30:53&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;Frankston Practic&quot;,
        &quot;email&quot;: &quot;admin@frankston.com.au&quot;,
        &quot;phone_number&quot;: &quot;03-2335-2342&quot;,
        &quot;fax_number&quot;: &quot;03-2435-6735&quot;,
        &quot;hospital_provider_number&quot;: &quot;AU5444&quot;,
        &quot;VAED_number&quot;: &quot;214124&quot;,
        &quot;Address&quot;: &quot;1 Dial blv, VIC, 3500&quot;,
        &quot;document_letter_header&quot;: &quot;filename&quot;,
        &quot;document_letter_footer&quot;: &quot;filename&quot;,
        &quot;created_at&quot;: &quot;2022-09-22 12:30:54&quot;,
        &quot;updated_at&quot;: &quot;2022-10-25 14:30:53&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETclinics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETclinics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETclinics"></code></pre>
</span>
<span id="execution-error-GETclinics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETclinics"></code></pre>
</span>
<form id="form-GETclinics" data-method="GET"
      data-path="clinics"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETclinics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETclinics"
                    onclick="tryItOut('GETclinics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETclinics"
                    onclick="cancelTryOut('GETclinics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETclinics" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>clinics</code></b>
        </p>
                <p>
            <label id="auth-GETclinics" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETclinics"
                                                                data-component="header"></label>
        </p>
                </form>

        <h1 id="endpoints">Endpoints</h1>

    

            <h2 id="endpoints-POSTlogin">[Authentication] - User Login</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/login" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"hrqugyubbunkaqoafdbowncheiyvfue\",
    \"email\": \"feil.pansy@example.org\",
    \"password\": \"giwihk\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "hrqugyubbunkaqoafdbowncheiyvfue",
    "email": "feil.pansy@example.org",
    "password": "giwihk"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogin">
</span>
<span id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"></code></pre>
</span>
<span id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin"></code></pre>
</span>
<form id="form-POSTlogin" data-method="POST"
      data-path="login"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogin"
                    onclick="tryItOut('POSTlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogin"
                    onclick="cancelTryOut('POSTlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogin" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>login</code></b>
        </p>
                <p>
            <label id="auth-POSTlogin" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTlogin"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTlogin"
               value="hrqugyubbunkaqoafdbowncheiyvfue"
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTlogin"
               value="feil.pansy@example.org"
               data-component="body" hidden>
    <br>
<p>Must be a valid email address.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTlogin"
               value="giwihk"
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-POSTverify_token">[Authentication] - Verify Token</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTverify_token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/verify_token" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/verify_token"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTverify_token">
</span>
<span id="execution-results-POSTverify_token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTverify_token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTverify_token"></code></pre>
</span>
<span id="execution-error-POSTverify_token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTverify_token"></code></pre>
</span>
<form id="form-POSTverify_token" data-method="POST"
      data-path="verify_token"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTverify_token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTverify_token"
                    onclick="tryItOut('POSTverify_token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTverify_token"
                    onclick="cancelTryOut('POSTverify_token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTverify_token" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>verify_token</code></b>
        </p>
                <p>
            <label id="auth-POSTverify_token" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTverify_token"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTlogout">[Authentication] - User Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTlogout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogout">
</span>
<span id="execution-results-POSTlogout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogout"></code></pre>
</span>
<span id="execution-error-POSTlogout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogout"></code></pre>
</span>
<form id="form-POSTlogout" data-method="POST"
      data-path="logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogout"
                    onclick="tryItOut('POSTlogout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogout"
                    onclick="cancelTryOut('POSTlogout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogout" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>logout</code></b>
        </p>
                <p>
            <label id="auth-POSTlogout" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTlogout"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTrefresh">[Authentication] - Refresh Token</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTrefresh">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/refresh" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/refresh"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTrefresh">
</span>
<span id="execution-results-POSTrefresh" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTrefresh"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTrefresh"></code></pre>
</span>
<span id="execution-error-POSTrefresh" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTrefresh"></code></pre>
</span>
<form id="form-POSTrefresh" data-method="POST"
      data-path="refresh"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTrefresh', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTrefresh"
                    onclick="tryItOut('POSTrefresh');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTrefresh"
                    onclick="cancelTryOut('POSTrefresh');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTrefresh" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>refresh</code></b>
        </p>
                <p>
            <label id="auth-POSTrefresh" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTrefresh"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETusers">[User] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETusers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/users" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETusers">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETusers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETusers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETusers"></code></pre>
</span>
<span id="execution-error-GETusers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETusers"></code></pre>
</span>
<form id="form-GETusers" data-method="GET"
      data-path="users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETusers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETusers"
                    onclick="tryItOut('GETusers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETusers"
                    onclick="cancelTryOut('GETusers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETusers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>users</code></b>
        </p>
                <p>
            <label id="auth-GETusers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETusers"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTupdate-profile">[User] - Update User Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTupdate-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/update-profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/update-profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTupdate-profile">
</span>
<span id="execution-results-POSTupdate-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTupdate-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTupdate-profile"></code></pre>
</span>
<span id="execution-error-POSTupdate-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTupdate-profile"></code></pre>
</span>
<form id="form-POSTupdate-profile" data-method="POST"
      data-path="update-profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTupdate-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTupdate-profile"
                    onclick="tryItOut('POSTupdate-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTupdate-profile"
                    onclick="cancelTryOut('POSTupdate-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTupdate-profile" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>update-profile</code></b>
        </p>
                <p>
            <label id="auth-POSTupdate-profile" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTupdate-profile"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETprofile">[User] - User Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETprofile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETprofile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETprofile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETprofile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETprofile"></code></pre>
</span>
<span id="execution-error-GETprofile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETprofile"></code></pre>
</span>
<form id="form-GETprofile" data-method="GET"
      data-path="profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETprofile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETprofile"
                    onclick="tryItOut('GETprofile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETprofile"
                    onclick="cancelTryOut('GETprofile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETprofile" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>profile</code></b>
        </p>
                <p>
            <label id="auth-GETprofile" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETprofile"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTchange-password">[User] - Update Password</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTchange-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/change-password" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"old_password\": \"w\",
    \"new_password\": \"ozu\",
    \"confirm_password\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/change-password"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "old_password": "w",
    "new_password": "ozu",
    "confirm_password": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTchange-password">
</span>
<span id="execution-results-POSTchange-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTchange-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTchange-password"></code></pre>
</span>
<span id="execution-error-POSTchange-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTchange-password"></code></pre>
</span>
<form id="form-POSTchange-password" data-method="POST"
      data-path="change-password"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTchange-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTchange-password"
                    onclick="tryItOut('POSTchange-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTchange-password"
                    onclick="cancelTryOut('POSTchange-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTchange-password" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>change-password</code></b>
        </p>
                <p>
            <label id="auth-POSTchange-password" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTchange-password"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>old_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="old_password"
               data-endpoint="POSTchange-password"
               value="w"
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
                <p>
            <b><code>new_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="new_password"
               data-endpoint="POSTchange-password"
               value="ozu"
               data-component="body" hidden>
    <br>
<p>The value and <code>old_password</code> must be different. Must be at least 6 characters.</p>
        </p>
                <p>
            <b><code>confirm_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="confirm_password"
               data-endpoint="POSTchange-password"
               value=""
               data-component="body" hidden>
    <br>
<p>The value and <code>new_password</code> must match. Must be at least 6 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-GETappointment_pre_admissions-show--token-">[Pre Admission] - Show Initial Form</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointment_pre_admissions-show--token-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointment_pre_admissions/show/dignissimos" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/show/dignissimos"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointment_pre_admissions-show--token-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointment_pre_admissions-show--token-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointment_pre_admissions-show--token-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointment_pre_admissions-show--token-"></code></pre>
</span>
<span id="execution-error-GETappointment_pre_admissions-show--token-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointment_pre_admissions-show--token-"></code></pre>
</span>
<form id="form-GETappointment_pre_admissions-show--token-" data-method="GET"
      data-path="appointment_pre_admissions/show/{token}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointment_pre_admissions-show--token-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointment_pre_admissions-show--token-"
                    onclick="tryItOut('GETappointment_pre_admissions-show--token-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointment_pre_admissions-show--token-"
                    onclick="cancelTryOut('GETappointment_pre_admissions-show--token-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointment_pre_admissions-show--token-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointment_pre_admissions/show/{token}</code></b>
        </p>
                <p>
            <label id="auth-GETappointment_pre_admissions-show--token-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointment_pre_admissions-show--token-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="token"
               data-endpoint="GETappointment_pre_admissions-show--token-"
               value="dignissimos"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-POSTappointment_pre_admissions-validate--token-">[Pre Admission] - Validate Pre Admission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointment_pre_admissions-validate--token-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointment_pre_admissions/validate/et" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/validate/et"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointment_pre_admissions-validate--token-">
</span>
<span id="execution-results-POSTappointment_pre_admissions-validate--token-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointment_pre_admissions-validate--token-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointment_pre_admissions-validate--token-"></code></pre>
</span>
<span id="execution-error-POSTappointment_pre_admissions-validate--token-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointment_pre_admissions-validate--token-"></code></pre>
</span>
<form id="form-POSTappointment_pre_admissions-validate--token-" data-method="POST"
      data-path="appointment_pre_admissions/validate/{token}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointment_pre_admissions-validate--token-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointment_pre_admissions-validate--token-"
                    onclick="tryItOut('POSTappointment_pre_admissions-validate--token-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointment_pre_admissions-validate--token-"
                    onclick="cancelTryOut('POSTappointment_pre_admissions-validate--token-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointment_pre_admissions-validate--token-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointment_pre_admissions/validate/{token}</code></b>
        </p>
                <p>
            <label id="auth-POSTappointment_pre_admissions-validate--token-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointment_pre_admissions-validate--token-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="token"
               data-endpoint="POSTappointment_pre_admissions-validate--token-"
               value="et"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-POSTappointment_pre_admissions-store--token-">[Pre Admission] - Create Pre Admission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointment_pre_admissions-store--token-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointment_pre_admissions/store/laborum" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/store/laborum"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointment_pre_admissions-store--token-">
</span>
<span id="execution-results-POSTappointment_pre_admissions-store--token-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointment_pre_admissions-store--token-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointment_pre_admissions-store--token-"></code></pre>
</span>
<span id="execution-error-POSTappointment_pre_admissions-store--token-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointment_pre_admissions-store--token-"></code></pre>
</span>
<form id="form-POSTappointment_pre_admissions-store--token-" data-method="POST"
      data-path="appointment_pre_admissions/store/{token}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointment_pre_admissions-store--token-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointment_pre_admissions-store--token-"
                    onclick="tryItOut('POSTappointment_pre_admissions-store--token-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointment_pre_admissions-store--token-"
                    onclick="cancelTryOut('POSTappointment_pre_admissions-store--token-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointment_pre_admissions-store--token-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointment_pre_admissions/store/{token}</code></b>
        </p>
                <p>
            <label id="auth-POSTappointment_pre_admissions-store--token-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointment_pre_admissions-store--token-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="token"
               data-endpoint="POSTappointment_pre_admissions-store--token-"
               value="laborum"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-POSTmails-send">[Mail] - Send</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTmails-send">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/mails/send" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"to_user_ids\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/send"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "to_user_ids": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmails-send">
</span>
<span id="execution-results-POSTmails-send" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmails-send"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmails-send"></code></pre>
</span>
<span id="execution-error-POSTmails-send" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmails-send"></code></pre>
</span>
<form id="form-POSTmails-send" data-method="POST"
      data-path="mails/send"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmails-send', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmails-send"
                    onclick="tryItOut('POSTmails-send');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmails-send"
                    onclick="cancelTryOut('POSTmails-send');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmails-send" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>mails/send</code></b>
        </p>
                <p>
            <label id="auth-POSTmails-send" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTmails-send"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>to_user_ids</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="to_user_ids"
               data-endpoint="POSTmails-send"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTmails-send-draft">[Mail] - Send Draft Mail</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTmails-send-draft">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/mails/send-draft" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"to_user_ids\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/send-draft"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "to_user_ids": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmails-send-draft">
</span>
<span id="execution-results-POSTmails-send-draft" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmails-send-draft"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmails-send-draft"></code></pre>
</span>
<span id="execution-error-POSTmails-send-draft" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmails-send-draft"></code></pre>
</span>
<form id="form-POSTmails-send-draft" data-method="POST"
      data-path="mails/send-draft"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmails-send-draft', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmails-send-draft"
                    onclick="tryItOut('POSTmails-send-draft');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmails-send-draft"
                    onclick="cancelTryOut('POSTmails-send-draft');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmails-send-draft" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>mails/send-draft</code></b>
        </p>
                <p>
            <label id="auth-POSTmails-send-draft" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTmails-send-draft"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>to_user_ids</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="to_user_ids"
               data-endpoint="POSTmails-send-draft"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTmails-update-draft">[Mail] - Update Draft.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTmails-update-draft">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/mails/update-draft" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"to_user_ids\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/update-draft"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "to_user_ids": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmails-update-draft">
</span>
<span id="execution-results-POSTmails-update-draft" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmails-update-draft"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmails-update-draft"></code></pre>
</span>
<span id="execution-error-POSTmails-update-draft" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmails-update-draft"></code></pre>
</span>
<form id="form-POSTmails-update-draft" data-method="POST"
      data-path="mails/update-draft"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmails-update-draft', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmails-update-draft"
                    onclick="tryItOut('POSTmails-update-draft');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmails-update-draft"
                    onclick="cancelTryOut('POSTmails-update-draft');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmails-update-draft" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>mails/update-draft</code></b>
        </p>
                <p>
            <label id="auth-POSTmails-update-draft" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTmails-update-draft"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>to_user_ids</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="to_user_ids"
               data-endpoint="POSTmails-update-draft"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTmails-bookmark--id-">[Mail] - Bookmark</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTmails-bookmark--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/mails/bookmark/voluptates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/bookmark/voluptates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTmails-bookmark--id-">
</span>
<span id="execution-results-PUTmails-bookmark--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTmails-bookmark--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTmails-bookmark--id-"></code></pre>
</span>
<span id="execution-error-PUTmails-bookmark--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTmails-bookmark--id-"></code></pre>
</span>
<form id="form-PUTmails-bookmark--id-" data-method="PUT"
      data-path="mails/bookmark/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTmails-bookmark--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTmails-bookmark--id-"
                    onclick="tryItOut('PUTmails-bookmark--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTmails-bookmark--id-"
                    onclick="cancelTryOut('PUTmails-bookmark--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTmails-bookmark--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>mails/bookmark/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTmails-bookmark--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTmails-bookmark--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTmails-bookmark--id-"
               value="voluptates"
               data-component="url" hidden>
    <br>
<p>The ID of the bookmark.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTmails-delete--id-">[Mail] - Move to Trash</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTmails-delete--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/mails/delete/minima" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/delete/minima"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTmails-delete--id-">
</span>
<span id="execution-results-PUTmails-delete--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTmails-delete--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTmails-delete--id-"></code></pre>
</span>
<span id="execution-error-PUTmails-delete--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTmails-delete--id-"></code></pre>
</span>
<form id="form-PUTmails-delete--id-" data-method="PUT"
      data-path="mails/delete/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTmails-delete--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTmails-delete--id-"
                    onclick="tryItOut('PUTmails-delete--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTmails-delete--id-"
                    onclick="cancelTryOut('PUTmails-delete--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTmails-delete--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>mails/delete/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTmails-delete--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTmails-delete--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTmails-delete--id-"
               value="minima"
               data-component="url" hidden>
    <br>
<p>The ID of the delete.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTmails-restore--id-">[Mail] - Restore from Trash</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTmails-restore--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/mails/restore/consequuntur" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/restore/consequuntur"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTmails-restore--id-">
</span>
<span id="execution-results-PUTmails-restore--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTmails-restore--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTmails-restore--id-"></code></pre>
</span>
<span id="execution-error-PUTmails-restore--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTmails-restore--id-"></code></pre>
</span>
<form id="form-PUTmails-restore--id-" data-method="PUT"
      data-path="mails/restore/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTmails-restore--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTmails-restore--id-"
                    onclick="tryItOut('PUTmails-restore--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTmails-restore--id-"
                    onclick="cancelTryOut('PUTmails-restore--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTmails-restore--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>mails/restore/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTmails-restore--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTmails-restore--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTmails-restore--id-"
               value="consequuntur"
               data-component="url" hidden>
    <br>
<p>The ID of the restore.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETmails">[Mail] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETmails">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/mails" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmails">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmails" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmails"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmails"></code></pre>
</span>
<span id="execution-error-GETmails" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmails"></code></pre>
</span>
<form id="form-GETmails" data-method="GET"
      data-path="mails"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmails', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmails"
                    onclick="tryItOut('GETmails');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmails"
                    onclick="cancelTryOut('GETmails');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmails" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>mails</code></b>
        </p>
                <p>
            <label id="auth-GETmails" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETmails"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTmails">[Mail] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTmails">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/mails" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"to_user_ids\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "to_user_ids": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmails">
</span>
<span id="execution-results-POSTmails" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmails"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmails"></code></pre>
</span>
<span id="execution-error-POSTmails" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmails"></code></pre>
</span>
<form id="form-POSTmails" data-method="POST"
      data-path="mails"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmails', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmails"
                    onclick="tryItOut('POSTmails');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmails"
                    onclick="cancelTryOut('POSTmails');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmails" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>mails</code></b>
        </p>
                <p>
            <label id="auth-POSTmails" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTmails"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>to_user_ids</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="to_user_ids"
               data-endpoint="POSTmails"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETmails--id-">[Mail] - Show</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETmails--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/mails/5" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/5"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmails--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETmails--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmails--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmails--id-"></code></pre>
</span>
<span id="execution-error-GETmails--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmails--id-"></code></pre>
</span>
<form id="form-GETmails--id-" data-method="GET"
      data-path="mails/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmails--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmails--id-"
                    onclick="tryItOut('GETmails--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmails--id-"
                    onclick="cancelTryOut('GETmails--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmails--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>mails/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETmails--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETmails--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETmails--id-"
               value="5"
               data-component="url" hidden>
    <br>
<p>The ID of the mail.</p>
            </p>
                    </form>

            <h2 id="endpoints-DELETEmails--id-">[Mail] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEmails--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/mails/17" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/17"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEmails--id-">
</span>
<span id="execution-results-DELETEmails--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEmails--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEmails--id-"></code></pre>
</span>
<span id="execution-error-DELETEmails--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEmails--id-"></code></pre>
</span>
<form id="form-DELETEmails--id-" data-method="DELETE"
      data-path="mails/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEmails--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEmails--id-"
                    onclick="tryItOut('DELETEmails--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEmails--id-"
                    onclick="cancelTryOut('DELETEmails--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEmails--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>mails/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEmails--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEmails--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEmails--id-"
               value="17"
               data-component="url" hidden>
    <br>
<p>The ID of the mail.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETadmins">[Admin User] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETadmins">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admins" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admins"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmins">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmins" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmins"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmins"></code></pre>
</span>
<span id="execution-error-GETadmins" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmins"></code></pre>
</span>
<form id="form-GETadmins" data-method="GET"
      data-path="admins"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmins', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmins"
                    onclick="tryItOut('GETadmins');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmins"
                    onclick="cancelTryOut('GETadmins');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmins" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admins</code></b>
        </p>
                <p>
            <label id="auth-GETadmins" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETadmins"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTadmins">[Admin User] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTadmins">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admins" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\",
    \"password\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admins"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": "",
    "password": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTadmins">
</span>
<span id="execution-results-POSTadmins" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmins"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmins"></code></pre>
</span>
<span id="execution-error-POSTadmins" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmins"></code></pre>
</span>
<form id="form-POSTadmins" data-method="POST"
      data-path="admins"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmins', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmins"
                    onclick="tryItOut('POSTadmins');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmins"
                    onclick="cancelTryOut('POSTadmins');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmins" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admins</code></b>
        </p>
                <p>
            <label id="auth-POSTadmins" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTadmins"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTadmins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTadmins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTadmins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTadmins--id-">[Admin User] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTadmins--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/admins/minus" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admins/minus"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTadmins--id-">
</span>
<span id="execution-results-PUTadmins--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTadmins--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTadmins--id-"></code></pre>
</span>
<span id="execution-error-PUTadmins--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTadmins--id-"></code></pre>
</span>
<form id="form-PUTadmins--id-" data-method="PUT"
      data-path="admins/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTadmins--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTadmins--id-"
                    onclick="tryItOut('PUTadmins--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTadmins--id-"
                    onclick="cancelTryOut('PUTadmins--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTadmins--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>admins/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>admins/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTadmins--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTadmins--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTadmins--id-"
               value="minus"
               data-component="url" hidden>
    <br>
<p>The ID of the admin.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="PUTadmins--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTadmins--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-DELETEadmins--id-">[Admin User] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEadmins--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/admins/accusamus" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admins/accusamus"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEadmins--id-">
</span>
<span id="execution-results-DELETEadmins--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEadmins--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEadmins--id-"></code></pre>
</span>
<span id="execution-error-DELETEadmins--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEadmins--id-"></code></pre>
</span>
<form id="form-DELETEadmins--id-" data-method="DELETE"
      data-path="admins/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEadmins--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEadmins--id-"
                    onclick="tryItOut('DELETEadmins--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEadmins--id-"
                    onclick="cancelTryOut('DELETEadmins--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEadmins--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>admins/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEadmins--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEadmins--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="DELETEadmins--id-"
               value="accusamus"
               data-component="url" hidden>
    <br>
<p>The ID of the admin.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETuser-roles">[User&#039;s Role] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETuser-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/user-roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/user-roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETuser-roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETuser-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETuser-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETuser-roles"></code></pre>
</span>
<span id="execution-error-GETuser-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETuser-roles"></code></pre>
</span>
<form id="form-GETuser-roles" data-method="GET"
      data-path="user-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETuser-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETuser-roles"
                    onclick="tryItOut('GETuser-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETuser-roles"
                    onclick="cancelTryOut('GETuser-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETuser-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>user-roles</code></b>
        </p>
                <p>
            <label id="auth-GETuser-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETuser-roles"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTuser-roles">[User&#039;s Role] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTuser-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/user-roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"slug\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/user-roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "slug": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTuser-roles">
</span>
<span id="execution-results-POSTuser-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTuser-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTuser-roles"></code></pre>
</span>
<span id="execution-error-POSTuser-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTuser-roles"></code></pre>
</span>
<form id="form-POSTuser-roles" data-method="POST"
      data-path="user-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTuser-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTuser-roles"
                    onclick="tryItOut('POSTuser-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTuser-roles"
                    onclick="cancelTryOut('POSTuser-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTuser-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>user-roles</code></b>
        </p>
                <p>
            <label id="auth-POSTuser-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTuser-roles"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTuser-roles"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>slug</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="slug"
               data-endpoint="POSTuser-roles"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTuser-roles--id-">[User&#039;s Role] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTuser-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/user-roles/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"slug\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/user-roles/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "slug": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTuser-roles--id-">
</span>
<span id="execution-results-PUTuser-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTuser-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTuser-roles--id-"></code></pre>
</span>
<span id="execution-error-PUTuser-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTuser-roles--id-"></code></pre>
</span>
<form id="form-PUTuser-roles--id-" data-method="PUT"
      data-path="user-roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTuser-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTuser-roles--id-"
                    onclick="tryItOut('PUTuser-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTuser-roles--id-"
                    onclick="cancelTryOut('PUTuser-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTuser-roles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>user-roles/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>user-roles/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTuser-roles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTuser-roles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTuser-roles--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the user role.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTuser-roles--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>slug</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="slug"
               data-endpoint="PUTuser-roles--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEuser-roles--id-">[User&#039;s Role] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEuser-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/user-roles/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/user-roles/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEuser-roles--id-">
</span>
<span id="execution-results-DELETEuser-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEuser-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEuser-roles--id-"></code></pre>
</span>
<span id="execution-error-DELETEuser-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEuser-roles--id-"></code></pre>
</span>
<form id="form-DELETEuser-roles--id-" data-method="DELETE"
      data-path="user-roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEuser-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEuser-roles--id-"
                    onclick="tryItOut('DELETEuser-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEuser-roles--id-"
                    onclick="cancelTryOut('DELETEuser-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEuser-roles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>user-roles/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEuser-roles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEuser-roles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEuser-roles--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the user role.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETorganizations">[Organization] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETorganizations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/organizations" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organizations"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETorganizations">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETorganizations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETorganizations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETorganizations"></code></pre>
</span>
<span id="execution-error-GETorganizations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorganizations"></code></pre>
</span>
<form id="form-GETorganizations" data-method="GET"
      data-path="organizations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETorganizations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETorganizations"
                    onclick="tryItOut('GETorganizations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETorganizations"
                    onclick="cancelTryOut('GETorganizations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETorganizations" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>organizations</code></b>
        </p>
                <p>
            <label id="auth-GETorganizations" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETorganizations"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTorganizations">[Organization] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTorganizations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/organizations" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"username\": \"\",
    \"email\": \"\",
    \"first_name\": \"\",
    \"last_name\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organizations"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "username": "",
    "email": "",
    "first_name": "",
    "last_name": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTorganizations">
</span>
<span id="execution-results-POSTorganizations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTorganizations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTorganizations"></code></pre>
</span>
<span id="execution-error-POSTorganizations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorganizations"></code></pre>
</span>
<form id="form-POSTorganizations" data-method="POST"
      data-path="organizations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTorganizations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTorganizations"
                    onclick="tryItOut('POSTorganizations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTorganizations"
                    onclick="cancelTryOut('POSTorganizations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTorganizations" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>organizations</code></b>
        </p>
                <p>
            <label id="auth-POSTorganizations" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTorganizations"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTorganizations"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTorganizations"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTorganizations"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="POSTorganizations"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="POSTorganizations"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTorganizations--id-">[Organization] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTorganizations--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/organizations/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"username\": \"\",
    \"email\": \"\",
    \"first_name\": \"\",
    \"last_name\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organizations/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "username": "",
    "email": "",
    "first_name": "",
    "last_name": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTorganizations--id-">
</span>
<span id="execution-results-PUTorganizations--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTorganizations--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTorganizations--id-"></code></pre>
</span>
<span id="execution-error-PUTorganizations--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorganizations--id-"></code></pre>
</span>
<form id="form-PUTorganizations--id-" data-method="PUT"
      data-path="organizations/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTorganizations--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTorganizations--id-"
                    onclick="tryItOut('PUTorganizations--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTorganizations--id-"
                    onclick="cancelTryOut('PUTorganizations--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTorganizations--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>organizations/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>organizations/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTorganizations--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTorganizations--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTorganizations--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the organization.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTorganizations--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="PUTorganizations--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTorganizations--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="PUTorganizations--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="PUTorganizations--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEorganizations--id-">[Organization] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEorganizations--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/organizations/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organizations/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEorganizations--id-">
</span>
<span id="execution-results-DELETEorganizations--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEorganizations--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorganizations--id-"></code></pre>
</span>
<span id="execution-error-DELETEorganizations--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorganizations--id-"></code></pre>
</span>
<form id="form-DELETEorganizations--id-" data-method="DELETE"
      data-path="organizations/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEorganizations--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEorganizations--id-"
                    onclick="tryItOut('DELETEorganizations--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEorganizations--id-"
                    onclick="cancelTryOut('DELETEorganizations--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEorganizations--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>organizations/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEorganizations--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEorganizations--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEorganizations--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the organization.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETbirth-codes">[Birth Code] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETbirth-codes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/birth-codes" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/birth-codes"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETbirth-codes">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETbirth-codes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETbirth-codes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETbirth-codes"></code></pre>
</span>
<span id="execution-error-GETbirth-codes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETbirth-codes"></code></pre>
</span>
<form id="form-GETbirth-codes" data-method="GET"
      data-path="birth-codes"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETbirth-codes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETbirth-codes"
                    onclick="tryItOut('GETbirth-codes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETbirth-codes"
                    onclick="cancelTryOut('GETbirth-codes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETbirth-codes" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>birth-codes</code></b>
        </p>
                <p>
            <label id="auth-GETbirth-codes" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETbirth-codes"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTbirth-codes">[Birth Code] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTbirth-codes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/birth-codes" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"code\": \"\",
    \"description\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/birth-codes"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "",
    "description": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTbirth-codes">
</span>
<span id="execution-results-POSTbirth-codes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTbirth-codes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTbirth-codes"></code></pre>
</span>
<span id="execution-error-POSTbirth-codes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTbirth-codes"></code></pre>
</span>
<form id="form-POSTbirth-codes" data-method="POST"
      data-path="birth-codes"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTbirth-codes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTbirth-codes"
                    onclick="tryItOut('POSTbirth-codes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTbirth-codes"
                    onclick="cancelTryOut('POSTbirth-codes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTbirth-codes" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>birth-codes</code></b>
        </p>
                <p>
            <label id="auth-POSTbirth-codes" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTbirth-codes"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="code"
               data-endpoint="POSTbirth-codes"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be 4 digits.</p>
        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="POSTbirth-codes"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTbirth-codes--id-">[Birth Code] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTbirth-codes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/birth-codes/13" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"code\": \"\",
    \"description\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/birth-codes/13"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "",
    "description": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTbirth-codes--id-">
</span>
<span id="execution-results-PUTbirth-codes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTbirth-codes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTbirth-codes--id-"></code></pre>
</span>
<span id="execution-error-PUTbirth-codes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTbirth-codes--id-"></code></pre>
</span>
<form id="form-PUTbirth-codes--id-" data-method="PUT"
      data-path="birth-codes/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTbirth-codes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTbirth-codes--id-"
                    onclick="tryItOut('PUTbirth-codes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTbirth-codes--id-"
                    onclick="cancelTryOut('PUTbirth-codes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTbirth-codes--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>birth-codes/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>birth-codes/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTbirth-codes--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTbirth-codes--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTbirth-codes--id-"
               value="13"
               data-component="url" hidden>
    <br>
<p>The ID of the birth code.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="code"
               data-endpoint="PUTbirth-codes--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be 4 digits.</p>
        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="PUTbirth-codes--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEbirth-codes--id-">[Birth Code] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEbirth-codes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/birth-codes/10" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/birth-codes/10"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEbirth-codes--id-">
</span>
<span id="execution-results-DELETEbirth-codes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEbirth-codes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEbirth-codes--id-"></code></pre>
</span>
<span id="execution-error-DELETEbirth-codes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEbirth-codes--id-"></code></pre>
</span>
<form id="form-DELETEbirth-codes--id-" data-method="DELETE"
      data-path="birth-codes/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEbirth-codes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEbirth-codes--id-"
                    onclick="tryItOut('DELETEbirth-codes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEbirth-codes--id-"
                    onclick="cancelTryOut('DELETEbirth-codes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEbirth-codes--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>birth-codes/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEbirth-codes--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEbirth-codes--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEbirth-codes--id-"
               value="10"
               data-component="url" hidden>
    <br>
<p>The ID of the birth code.</p>
            </p>
                    </form>

            <h2 id="endpoints-GEThealth-funds">[Health Fund] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GEThealth-funds">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/health-funds" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/health-funds"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GEThealth-funds">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GEThealth-funds" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GEThealth-funds"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GEThealth-funds"></code></pre>
</span>
<span id="execution-error-GEThealth-funds" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GEThealth-funds"></code></pre>
</span>
<form id="form-GEThealth-funds" data-method="GET"
      data-path="health-funds"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GEThealth-funds', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GEThealth-funds"
                    onclick="tryItOut('GEThealth-funds');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GEThealth-funds"
                    onclick="cancelTryOut('GEThealth-funds');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GEThealth-funds" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>health-funds</code></b>
        </p>
                <p>
            <label id="auth-GEThealth-funds" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GEThealth-funds"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSThealth-funds">[Health Fund] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSThealth-funds">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/health-funds" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/health-funds"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSThealth-funds">
</span>
<span id="execution-results-POSThealth-funds" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSThealth-funds"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSThealth-funds"></code></pre>
</span>
<span id="execution-error-POSThealth-funds" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSThealth-funds"></code></pre>
</span>
<form id="form-POSThealth-funds" data-method="POST"
      data-path="health-funds"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSThealth-funds', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSThealth-funds"
                    onclick="tryItOut('POSThealth-funds');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSThealth-funds"
                    onclick="cancelTryOut('POSThealth-funds');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSThealth-funds" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>health-funds</code></b>
        </p>
                <p>
            <label id="auth-POSThealth-funds" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSThealth-funds"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-PUThealth-funds--id-">[Health Fund] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUThealth-funds--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/health-funds/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/health-funds/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUThealth-funds--id-">
</span>
<span id="execution-results-PUThealth-funds--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUThealth-funds--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUThealth-funds--id-"></code></pre>
</span>
<span id="execution-error-PUThealth-funds--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUThealth-funds--id-"></code></pre>
</span>
<form id="form-PUThealth-funds--id-" data-method="PUT"
      data-path="health-funds/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUThealth-funds--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUThealth-funds--id-"
                    onclick="tryItOut('PUThealth-funds--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUThealth-funds--id-"
                    onclick="cancelTryOut('PUThealth-funds--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUThealth-funds--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>health-funds/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>health-funds/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUThealth-funds--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUThealth-funds--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUThealth-funds--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the health fund.</p>
            </p>
                    </form>

            <h2 id="endpoints-DELETEhealth-funds--id-">[Health Fund] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEhealth-funds--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/health-funds/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/health-funds/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEhealth-funds--id-">
</span>
<span id="execution-results-DELETEhealth-funds--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEhealth-funds--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEhealth-funds--id-"></code></pre>
</span>
<span id="execution-error-DELETEhealth-funds--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEhealth-funds--id-"></code></pre>
</span>
<form id="form-DELETEhealth-funds--id-" data-method="DELETE"
      data-path="health-funds/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEhealth-funds--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEhealth-funds--id-"
                    onclick="tryItOut('DELETEhealth-funds--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEhealth-funds--id-"
                    onclick="cancelTryOut('DELETEhealth-funds--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEhealth-funds--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>health-funds/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEhealth-funds--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEhealth-funds--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEhealth-funds--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the health fund.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETorganization-admins">[Organization Admin] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETorganization-admins">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/organization-admins" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-admins"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETorganization-admins">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETorganization-admins" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETorganization-admins"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETorganization-admins"></code></pre>
</span>
<span id="execution-error-GETorganization-admins" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorganization-admins"></code></pre>
</span>
<form id="form-GETorganization-admins" data-method="GET"
      data-path="organization-admins"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETorganization-admins', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETorganization-admins"
                    onclick="tryItOut('GETorganization-admins');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETorganization-admins"
                    onclick="cancelTryOut('GETorganization-admins');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETorganization-admins" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>organization-admins</code></b>
        </p>
                <p>
            <label id="auth-GETorganization-admins" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETorganization-admins"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTorganization-admins">[Organization Admin] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTorganization-admins">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/organization-admins" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\",
    \"password\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-admins"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": "",
    "password": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTorganization-admins">
</span>
<span id="execution-results-POSTorganization-admins" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTorganization-admins"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTorganization-admins"></code></pre>
</span>
<span id="execution-error-POSTorganization-admins" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorganization-admins"></code></pre>
</span>
<form id="form-POSTorganization-admins" data-method="POST"
      data-path="organization-admins"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTorganization-admins', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTorganization-admins"
                    onclick="tryItOut('POSTorganization-admins');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTorganization-admins"
                    onclick="cancelTryOut('POSTorganization-admins');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTorganization-admins" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>organization-admins</code></b>
        </p>
                <p>
            <label id="auth-POSTorganization-admins" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTorganization-admins"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTorganization-admins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTorganization-admins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTorganization-admins"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTorganization-admins--id-">[Organization Admin] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTorganization-admins--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/organization-admins/nisi" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-admins/nisi"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTorganization-admins--id-">
</span>
<span id="execution-results-PUTorganization-admins--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTorganization-admins--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTorganization-admins--id-"></code></pre>
</span>
<span id="execution-error-PUTorganization-admins--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorganization-admins--id-"></code></pre>
</span>
<form id="form-PUTorganization-admins--id-" data-method="PUT"
      data-path="organization-admins/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTorganization-admins--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTorganization-admins--id-"
                    onclick="tryItOut('PUTorganization-admins--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTorganization-admins--id-"
                    onclick="cancelTryOut('PUTorganization-admins--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTorganization-admins--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>organization-admins/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>organization-admins/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTorganization-admins--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTorganization-admins--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTorganization-admins--id-"
               value="nisi"
               data-component="url" hidden>
    <br>
<p>The ID of the organization admin.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="PUTorganization-admins--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTorganization-admins--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-DELETEorganization-admins--id-">[Organization Admin] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEorganization-admins--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/organization-admins/officia" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-admins/officia"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEorganization-admins--id-">
</span>
<span id="execution-results-DELETEorganization-admins--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEorganization-admins--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorganization-admins--id-"></code></pre>
</span>
<span id="execution-error-DELETEorganization-admins--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorganization-admins--id-"></code></pre>
</span>
<form id="form-DELETEorganization-admins--id-" data-method="DELETE"
      data-path="organization-admins/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEorganization-admins--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEorganization-admins--id-"
                    onclick="tryItOut('DELETEorganization-admins--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEorganization-admins--id-"
                    onclick="cancelTryOut('DELETEorganization-admins--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEorganization-admins--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>organization-admins/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEorganization-admins--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEorganization-admins--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="DELETEorganization-admins--id-"
               value="officia"
               data-component="url" hidden>
    <br>
<p>The ID of the organization admin.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETorganization-managers">[Organization Manager] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETorganization-managers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/organization-managers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-managers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETorganization-managers">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETorganization-managers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETorganization-managers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETorganization-managers"></code></pre>
</span>
<span id="execution-error-GETorganization-managers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETorganization-managers"></code></pre>
</span>
<form id="form-GETorganization-managers" data-method="GET"
      data-path="organization-managers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETorganization-managers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETorganization-managers"
                    onclick="tryItOut('GETorganization-managers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETorganization-managers"
                    onclick="cancelTryOut('GETorganization-managers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETorganization-managers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>organization-managers</code></b>
        </p>
                <p>
            <label id="auth-GETorganization-managers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETorganization-managers"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTorganization-managers">[Organization Manager] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTorganization-managers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/organization-managers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\",
    \"password\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-managers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": "",
    "password": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTorganization-managers">
</span>
<span id="execution-results-POSTorganization-managers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTorganization-managers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTorganization-managers"></code></pre>
</span>
<span id="execution-error-POSTorganization-managers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTorganization-managers"></code></pre>
</span>
<form id="form-POSTorganization-managers" data-method="POST"
      data-path="organization-managers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTorganization-managers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTorganization-managers"
                    onclick="tryItOut('POSTorganization-managers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTorganization-managers"
                    onclick="cancelTryOut('POSTorganization-managers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTorganization-managers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>organization-managers</code></b>
        </p>
                <p>
            <label id="auth-POSTorganization-managers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTorganization-managers"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTorganization-managers"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTorganization-managers"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTorganization-managers"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTorganization-managers--id-">[Organization Manager] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTorganization-managers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/organization-managers/modi" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"\",
    \"email\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-managers/modi"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "",
    "email": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTorganization-managers--id-">
</span>
<span id="execution-results-PUTorganization-managers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTorganization-managers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTorganization-managers--id-"></code></pre>
</span>
<span id="execution-error-PUTorganization-managers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTorganization-managers--id-"></code></pre>
</span>
<form id="form-PUTorganization-managers--id-" data-method="PUT"
      data-path="organization-managers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTorganization-managers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTorganization-managers--id-"
                    onclick="tryItOut('PUTorganization-managers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTorganization-managers--id-"
                    onclick="cancelTryOut('PUTorganization-managers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTorganization-managers--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>organization-managers/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>organization-managers/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTorganization-managers--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTorganization-managers--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTorganization-managers--id-"
               value="modi"
               data-component="url" hidden>
    <br>
<p>The ID of the organization manager.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="PUTorganization-managers--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTorganization-managers--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-DELETEorganization-managers--id-">[Organization Manager] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEorganization-managers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/organization-managers/et" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-managers/et"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEorganization-managers--id-">
</span>
<span id="execution-results-DELETEorganization-managers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEorganization-managers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEorganization-managers--id-"></code></pre>
</span>
<span id="execution-error-DELETEorganization-managers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEorganization-managers--id-"></code></pre>
</span>
<form id="form-DELETEorganization-managers--id-" data-method="DELETE"
      data-path="organization-managers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEorganization-managers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEorganization-managers--id-"
                    onclick="tryItOut('DELETEorganization-managers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEorganization-managers--id-"
                    onclick="cancelTryOut('DELETEorganization-managers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEorganization-managers--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>organization-managers/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEorganization-managers--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEorganization-managers--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="DELETEorganization-managers--id-"
               value="et"
               data-component="url" hidden>
    <br>
<p>The ID of the organization manager.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETemail-templates">[Email Template] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETemail-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/email-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/email-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETemail-templates">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETemail-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETemail-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETemail-templates"></code></pre>
</span>
<span id="execution-error-GETemail-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETemail-templates"></code></pre>
</span>
<form id="form-GETemail-templates" data-method="GET"
      data-path="email-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETemail-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETemail-templates"
                    onclick="tryItOut('GETemail-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETemail-templates"
                    onclick="cancelTryOut('GETemail-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETemail-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>email-templates</code></b>
        </p>
                <p>
            <label id="auth-GETemail-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETemail-templates"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTemail-templates">[Email Template] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTemail-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/email-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"key\": \"\",
    \"subject\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/email-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "key": "",
    "subject": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTemail-templates">
</span>
<span id="execution-results-POSTemail-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTemail-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTemail-templates"></code></pre>
</span>
<span id="execution-error-POSTemail-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTemail-templates"></code></pre>
</span>
<form id="form-POSTemail-templates" data-method="POST"
      data-path="email-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTemail-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTemail-templates"
                    onclick="tryItOut('POSTemail-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTemail-templates"
                    onclick="cancelTryOut('POSTemail-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTemail-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>email-templates</code></b>
        </p>
                <p>
            <label id="auth-POSTemail-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTemail-templates"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>key</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="key"
               data-endpoint="POSTemail-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>subject</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="subject"
               data-endpoint="POSTemail-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTemail-templates--id-">[Email Template] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTemail-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/email-templates/10" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"key\": \"\",
    \"subject\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/email-templates/10"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "key": "",
    "subject": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTemail-templates--id-">
</span>
<span id="execution-results-PUTemail-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTemail-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTemail-templates--id-"></code></pre>
</span>
<span id="execution-error-PUTemail-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTemail-templates--id-"></code></pre>
</span>
<form id="form-PUTemail-templates--id-" data-method="PUT"
      data-path="email-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTemail-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTemail-templates--id-"
                    onclick="tryItOut('PUTemail-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTemail-templates--id-"
                    onclick="cancelTryOut('PUTemail-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTemail-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>email-templates/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>email-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTemail-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTemail-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTemail-templates--id-"
               value="10"
               data-component="url" hidden>
    <br>
<p>The ID of the email template.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>key</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="key"
               data-endpoint="PUTemail-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>subject</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="subject"
               data-endpoint="PUTemail-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEemail-templates--id-">[Email Template] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEemail-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/email-templates/9" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/email-templates/9"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEemail-templates--id-">
</span>
<span id="execution-results-DELETEemail-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEemail-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEemail-templates--id-"></code></pre>
</span>
<span id="execution-error-DELETEemail-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEemail-templates--id-"></code></pre>
</span>
<form id="form-DELETEemail-templates--id-" data-method="DELETE"
      data-path="email-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEemail-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEemail-templates--id-"
                    onclick="tryItOut('DELETEemail-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEemail-templates--id-"
                    onclick="cancelTryOut('DELETEemail-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEemail-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>email-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEemail-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEemail-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEemail-templates--id-"
               value="9"
               data-component="url" hidden>
    <br>
<p>The ID of the email template.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETappointment-time-requirements">[Appointment Time Requirement] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointment-time-requirements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointment-time-requirements" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-time-requirements"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointment-time-requirements">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointment-time-requirements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointment-time-requirements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointment-time-requirements"></code></pre>
</span>
<span id="execution-error-GETappointment-time-requirements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointment-time-requirements"></code></pre>
</span>
<form id="form-GETappointment-time-requirements" data-method="GET"
      data-path="appointment-time-requirements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointment-time-requirements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointment-time-requirements"
                    onclick="tryItOut('GETappointment-time-requirements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointment-time-requirements"
                    onclick="cancelTryOut('GETappointment-time-requirements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointment-time-requirements" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointment-time-requirements</code></b>
        </p>
                <p>
            <label id="auth-GETappointment-time-requirements" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointment-time-requirements"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTappointment-time-requirements">[Appointment Time Requirement] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointment-time-requirements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointment-time-requirements" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\",
    \"base_time\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-time-requirements"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "",
    "base_time": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointment-time-requirements">
</span>
<span id="execution-results-POSTappointment-time-requirements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointment-time-requirements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointment-time-requirements"></code></pre>
</span>
<span id="execution-error-POSTappointment-time-requirements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointment-time-requirements"></code></pre>
</span>
<form id="form-POSTappointment-time-requirements" data-method="POST"
      data-path="appointment-time-requirements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointment-time-requirements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointment-time-requirements"
                    onclick="tryItOut('POSTappointment-time-requirements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointment-time-requirements"
                    onclick="cancelTryOut('POSTappointment-time-requirements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointment-time-requirements" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointment-time-requirements</code></b>
        </p>
                <p>
            <label id="auth-POSTappointment-time-requirements" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointment-time-requirements"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTappointment-time-requirements"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>base_time</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="base_time"
               data-endpoint="POSTappointment-time-requirements"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTappointment-time-requirements--id-">[Appointment Time Requirement] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointment-time-requirements--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointment-time-requirements/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\",
    \"base_time\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-time-requirements/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "",
    "base_time": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointment-time-requirements--id-">
</span>
<span id="execution-results-PUTappointment-time-requirements--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointment-time-requirements--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointment-time-requirements--id-"></code></pre>
</span>
<span id="execution-error-PUTappointment-time-requirements--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointment-time-requirements--id-"></code></pre>
</span>
<form id="form-PUTappointment-time-requirements--id-" data-method="PUT"
      data-path="appointment-time-requirements/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointment-time-requirements--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointment-time-requirements--id-"
                    onclick="tryItOut('PUTappointment-time-requirements--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointment-time-requirements--id-"
                    onclick="cancelTryOut('PUTappointment-time-requirements--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointment-time-requirements--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointment-time-requirements/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>appointment-time-requirements/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointment-time-requirements--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointment-time-requirements--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTappointment-time-requirements--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment time requirement.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTappointment-time-requirements--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>base_time</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="base_time"
               data-endpoint="PUTappointment-time-requirements--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEappointment-time-requirements--id-">[Appointment Time Requirement] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEappointment-time-requirements--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/appointment-time-requirements/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-time-requirements/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEappointment-time-requirements--id-">
</span>
<span id="execution-results-DELETEappointment-time-requirements--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEappointment-time-requirements--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEappointment-time-requirements--id-"></code></pre>
</span>
<span id="execution-error-DELETEappointment-time-requirements--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEappointment-time-requirements--id-"></code></pre>
</span>
<form id="form-DELETEappointment-time-requirements--id-" data-method="DELETE"
      data-path="appointment-time-requirements/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEappointment-time-requirements--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEappointment-time-requirements--id-"
                    onclick="tryItOut('DELETEappointment-time-requirements--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEappointment-time-requirements--id-"
                    onclick="cancelTryOut('DELETEappointment-time-requirements--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEappointment-time-requirements--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>appointment-time-requirements/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEappointment-time-requirements--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEappointment-time-requirements--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEappointment-time-requirements--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment time requirement.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETappointment-types">[Appointment Type] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointment-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointment-types" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-types"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointment-types">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointment-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointment-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointment-types"></code></pre>
</span>
<span id="execution-error-GETappointment-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointment-types"></code></pre>
</span>
<form id="form-GETappointment-types" data-method="GET"
      data-path="appointment-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointment-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointment-types"
                    onclick="tryItOut('GETappointment-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointment-types"
                    onclick="cancelTryOut('GETappointment-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointment-types" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointment-types</code></b>
        </p>
                <p>
            <label id="auth-GETappointment-types" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointment-types"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTappointment-types">[Appointment Type] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointment-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointment-types" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"anesthetist_required\": false,
    \"invoice_by\": \"\",
    \"arrival_time\": 0,
    \"procedure_price\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-types"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "anesthetist_required": false,
    "invoice_by": "",
    "arrival_time": 0,
    "procedure_price": 0
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointment-types">
</span>
<span id="execution-results-POSTappointment-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointment-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointment-types"></code></pre>
</span>
<span id="execution-error-POSTappointment-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointment-types"></code></pre>
</span>
<form id="form-POSTappointment-types" data-method="POST"
      data-path="appointment-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointment-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointment-types"
                    onclick="tryItOut('POSTappointment-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointment-types"
                    onclick="cancelTryOut('POSTappointment-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointment-types" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointment-types</code></b>
        </p>
                <p>
            <label id="auth-POSTappointment-types" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointment-types"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTappointment-types"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_required</code></b>&nbsp;&nbsp;<small>boolean</small>  &nbsp;
                <label data-endpoint="POSTappointment-types" hidden>
            <input type="radio" name="anesthetist_required"
                   value="true"
                   data-endpoint="POSTappointment-types"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="POSTappointment-types" hidden>
            <input type="radio" name="anesthetist_required"
                   value="false"
                   data-endpoint="POSTappointment-types"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
                <p>
            <b><code>invoice_by</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="invoice_by"
               data-endpoint="POSTappointment-types"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>arrival_time</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="arrival_time"
               data-endpoint="POSTappointment-types"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>procedure_price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="procedure_price"
               data-endpoint="POSTappointment-types"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTappointment-types--id-">[Appointment Type] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointment-types--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointment-types/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"anesthetist_required\": false,
    \"invoice_by\": \"\",
    \"arrival_time\": 0,
    \"procedure_price\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-types/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "anesthetist_required": false,
    "invoice_by": "",
    "arrival_time": 0,
    "procedure_price": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointment-types--id-">
</span>
<span id="execution-results-PUTappointment-types--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointment-types--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointment-types--id-"></code></pre>
</span>
<span id="execution-error-PUTappointment-types--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointment-types--id-"></code></pre>
</span>
<form id="form-PUTappointment-types--id-" data-method="PUT"
      data-path="appointment-types/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointment-types--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointment-types--id-"
                    onclick="tryItOut('PUTappointment-types--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointment-types--id-"
                    onclick="cancelTryOut('PUTappointment-types--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointment-types--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointment-types/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>appointment-types/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointment-types--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointment-types--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTappointment-types--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment type.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTappointment-types--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_required</code></b>&nbsp;&nbsp;<small>boolean</small>  &nbsp;
                <label data-endpoint="PUTappointment-types--id-" hidden>
            <input type="radio" name="anesthetist_required"
                   value="true"
                   data-endpoint="PUTappointment-types--id-"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="PUTappointment-types--id-" hidden>
            <input type="radio" name="anesthetist_required"
                   value="false"
                   data-endpoint="PUTappointment-types--id-"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
                <p>
            <b><code>invoice_by</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="invoice_by"
               data-endpoint="PUTappointment-types--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>arrival_time</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="arrival_time"
               data-endpoint="PUTappointment-types--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>procedure_price</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="procedure_price"
               data-endpoint="PUTappointment-types--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEappointment-types--id-">[Appointment Type] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEappointment-types--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/appointment-types/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-types/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEappointment-types--id-">
</span>
<span id="execution-results-DELETEappointment-types--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEappointment-types--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEappointment-types--id-"></code></pre>
</span>
<span id="execution-error-DELETEappointment-types--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEappointment-types--id-"></code></pre>
</span>
<form id="form-DELETEappointment-types--id-" data-method="DELETE"
      data-path="appointment-types/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEappointment-types--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEappointment-types--id-"
                    onclick="tryItOut('DELETEappointment-types--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEappointment-types--id-"
                    onclick="cancelTryOut('DELETEappointment-types--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEappointment-types--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>appointment-types/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEappointment-types--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEappointment-types--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEappointment-types--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment type.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETproda-devices">[Proda Device] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETproda-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/proda-devices" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/proda-devices"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETproda-devices">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETproda-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETproda-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETproda-devices"></code></pre>
</span>
<span id="execution-error-GETproda-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETproda-devices"></code></pre>
</span>
<form id="form-GETproda-devices" data-method="GET"
      data-path="proda-devices"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETproda-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETproda-devices"
                    onclick="tryItOut('GETproda-devices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETproda-devices"
                    onclick="cancelTryOut('GETproda-devices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETproda-devices" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>proda-devices</code></b>
        </p>
                <p>
            <label id="auth-GETproda-devices" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETproda-devices"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTproda-devices">[Proda Device] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTproda-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/proda-devices" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"device_name\": \"\",
    \"key_expiry\": \"\",
    \"device_expiry\": \"\",
    \"clinic_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/proda-devices"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "device_name": "",
    "key_expiry": "",
    "device_expiry": "",
    "clinic_id": 0
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTproda-devices">
</span>
<span id="execution-results-POSTproda-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTproda-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTproda-devices"></code></pre>
</span>
<span id="execution-error-POSTproda-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTproda-devices"></code></pre>
</span>
<form id="form-POSTproda-devices" data-method="POST"
      data-path="proda-devices"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTproda-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTproda-devices"
                    onclick="tryItOut('POSTproda-devices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTproda-devices"
                    onclick="cancelTryOut('POSTproda-devices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTproda-devices" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>proda-devices</code></b>
        </p>
                <p>
            <label id="auth-POSTproda-devices" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTproda-devices"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>device_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="device_name"
               data-endpoint="POSTproda-devices"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>key_expiry</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="key_expiry"
               data-endpoint="POSTproda-devices"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>device_expiry</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="device_expiry"
               data-endpoint="POSTproda-devices"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="POSTproda-devices"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTproda-devices--id-">[Proda Device] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTproda-devices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/proda-devices/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"device_name\": \"\",
    \"key_expiry\": \"\",
    \"device_expiry\": \"\",
    \"clinic_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/proda-devices/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "device_name": "",
    "key_expiry": "",
    "device_expiry": "",
    "clinic_id": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTproda-devices--id-">
</span>
<span id="execution-results-PUTproda-devices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTproda-devices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTproda-devices--id-"></code></pre>
</span>
<span id="execution-error-PUTproda-devices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTproda-devices--id-"></code></pre>
</span>
<form id="form-PUTproda-devices--id-" data-method="PUT"
      data-path="proda-devices/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTproda-devices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTproda-devices--id-"
                    onclick="tryItOut('PUTproda-devices--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTproda-devices--id-"
                    onclick="cancelTryOut('PUTproda-devices--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTproda-devices--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>proda-devices/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>proda-devices/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTproda-devices--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTproda-devices--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTproda-devices--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the proda device.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>device_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="device_name"
               data-endpoint="PUTproda-devices--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>key_expiry</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="key_expiry"
               data-endpoint="PUTproda-devices--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>device_expiry</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="device_expiry"
               data-endpoint="PUTproda-devices--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="PUTproda-devices--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEproda-devices--id-">[Proda Device] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEproda-devices--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/proda-devices/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/proda-devices/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEproda-devices--id-">
</span>
<span id="execution-results-DELETEproda-devices--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEproda-devices--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEproda-devices--id-"></code></pre>
</span>
<span id="execution-error-DELETEproda-devices--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEproda-devices--id-"></code></pre>
</span>
<form id="form-DELETEproda-devices--id-" data-method="DELETE"
      data-path="proda-devices/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEproda-devices--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEproda-devices--id-"
                    onclick="tryItOut('DELETEproda-devices--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEproda-devices--id-"
                    onclick="cancelTryOut('DELETEproda-devices--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEproda-devices--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>proda-devices/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEproda-devices--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEproda-devices--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEproda-devices--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the proda device.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETnotification-templates">[Notification Template] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETnotification-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/notification-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/notification-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETnotification-templates">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETnotification-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETnotification-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETnotification-templates"></code></pre>
</span>
<span id="execution-error-GETnotification-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETnotification-templates"></code></pre>
</span>
<form id="form-GETnotification-templates" data-method="GET"
      data-path="notification-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETnotification-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETnotification-templates"
                    onclick="tryItOut('GETnotification-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETnotification-templates"
                    onclick="cancelTryOut('GETnotification-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETnotification-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>notification-templates</code></b>
        </p>
                <p>
            <label id="auth-GETnotification-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETnotification-templates"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTnotification-templates">[Notification Template] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTnotification-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/notification-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"days_before\": 0,
    \"subject\": \"\",
    \"sms_template\": \"\",
    \"email_print_template\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/notification-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "days_before": 0,
    "subject": "",
    "sms_template": "",
    "email_print_template": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTnotification-templates">
</span>
<span id="execution-results-POSTnotification-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTnotification-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTnotification-templates"></code></pre>
</span>
<span id="execution-error-POSTnotification-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTnotification-templates"></code></pre>
</span>
<form id="form-POSTnotification-templates" data-method="POST"
      data-path="notification-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTnotification-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTnotification-templates"
                    onclick="tryItOut('POSTnotification-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTnotification-templates"
                    onclick="cancelTryOut('POSTnotification-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTnotification-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>notification-templates</code></b>
        </p>
                <p>
            <label id="auth-POSTnotification-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTnotification-templates"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>days_before</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="days_before"
               data-endpoint="POSTnotification-templates"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>subject</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="subject"
               data-endpoint="POSTnotification-templates"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>sms_template</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="sms_template"
               data-endpoint="POSTnotification-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email_print_template</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email_print_template"
               data-endpoint="POSTnotification-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTnotification-templates--id-">[Notification Template] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTnotification-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/notification-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"days_before\": 0,
    \"subject\": \"\",
    \"sms_template\": \"\",
    \"email_print_template\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/notification-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "days_before": 0,
    "subject": "",
    "sms_template": "",
    "email_print_template": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTnotification-templates--id-">
</span>
<span id="execution-results-PUTnotification-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTnotification-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTnotification-templates--id-"></code></pre>
</span>
<span id="execution-error-PUTnotification-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTnotification-templates--id-"></code></pre>
</span>
<form id="form-PUTnotification-templates--id-" data-method="PUT"
      data-path="notification-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTnotification-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTnotification-templates--id-"
                    onclick="tryItOut('PUTnotification-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTnotification-templates--id-"
                    onclick="cancelTryOut('PUTnotification-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTnotification-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>notification-templates/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>notification-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTnotification-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTnotification-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTnotification-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the notification template.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>days_before</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="days_before"
               data-endpoint="PUTnotification-templates--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>subject</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="subject"
               data-endpoint="PUTnotification-templates--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>sms_template</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="sms_template"
               data-endpoint="PUTnotification-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email_print_template</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email_print_template"
               data-endpoint="PUTnotification-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEnotification-templates--id-">[Notification Template] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEnotification-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/notification-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/notification-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEnotification-templates--id-">
</span>
<span id="execution-results-DELETEnotification-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEnotification-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEnotification-templates--id-"></code></pre>
</span>
<span id="execution-error-DELETEnotification-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEnotification-templates--id-"></code></pre>
</span>
<form id="form-DELETEnotification-templates--id-" data-method="DELETE"
      data-path="notification-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEnotification-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEnotification-templates--id-"
                    onclick="tryItOut('DELETEnotification-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEnotification-templates--id-"
                    onclick="cancelTryOut('DELETEnotification-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEnotification-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>notification-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEnotification-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEnotification-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEnotification-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the notification template.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETanesthetic-questions">[Anesthetic Question] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETanesthetic-questions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/anesthetic-questions" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETanesthetic-questions">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETanesthetic-questions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETanesthetic-questions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETanesthetic-questions"></code></pre>
</span>
<span id="execution-error-GETanesthetic-questions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETanesthetic-questions"></code></pre>
</span>
<form id="form-GETanesthetic-questions" data-method="GET"
      data-path="anesthetic-questions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETanesthetic-questions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETanesthetic-questions"
                    onclick="tryItOut('GETanesthetic-questions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETanesthetic-questions"
                    onclick="cancelTryOut('GETanesthetic-questions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETanesthetic-questions" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>anesthetic-questions</code></b>
        </p>
                <p>
            <label id="auth-GETanesthetic-questions" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETanesthetic-questions"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTanesthetic-questions">[Anesthetic Question] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTanesthetic-questions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/anesthetic-questions" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTanesthetic-questions">
</span>
<span id="execution-results-POSTanesthetic-questions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTanesthetic-questions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTanesthetic-questions"></code></pre>
</span>
<span id="execution-error-POSTanesthetic-questions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTanesthetic-questions"></code></pre>
</span>
<form id="form-POSTanesthetic-questions" data-method="POST"
      data-path="anesthetic-questions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTanesthetic-questions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTanesthetic-questions"
                    onclick="tryItOut('POSTanesthetic-questions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTanesthetic-questions"
                    onclick="cancelTryOut('POSTanesthetic-questions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTanesthetic-questions" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>anesthetic-questions</code></b>
        </p>
                <p>
            <label id="auth-POSTanesthetic-questions" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTanesthetic-questions"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-PUTanesthetic-questions--id-">[Anesthetic Question] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTanesthetic-questions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/anesthetic-questions/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTanesthetic-questions--id-">
</span>
<span id="execution-results-PUTanesthetic-questions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTanesthetic-questions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTanesthetic-questions--id-"></code></pre>
</span>
<span id="execution-error-PUTanesthetic-questions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTanesthetic-questions--id-"></code></pre>
</span>
<form id="form-PUTanesthetic-questions--id-" data-method="PUT"
      data-path="anesthetic-questions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTanesthetic-questions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTanesthetic-questions--id-"
                    onclick="tryItOut('PUTanesthetic-questions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTanesthetic-questions--id-"
                    onclick="cancelTryOut('PUTanesthetic-questions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTanesthetic-questions--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>anesthetic-questions/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>anesthetic-questions/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTanesthetic-questions--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTanesthetic-questions--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTanesthetic-questions--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the anesthetic question.</p>
            </p>
                    </form>

            <h2 id="endpoints-DELETEanesthetic-questions--id-">[Anesthetic Question] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEanesthetic-questions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/anesthetic-questions/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEanesthetic-questions--id-">
</span>
<span id="execution-results-DELETEanesthetic-questions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEanesthetic-questions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEanesthetic-questions--id-"></code></pre>
</span>
<span id="execution-error-DELETEanesthetic-questions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEanesthetic-questions--id-"></code></pre>
</span>
<form id="form-DELETEanesthetic-questions--id-" data-method="DELETE"
      data-path="anesthetic-questions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEanesthetic-questions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEanesthetic-questions--id-"
                    onclick="tryItOut('DELETEanesthetic-questions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEanesthetic-questions--id-"
                    onclick="cancelTryOut('DELETEanesthetic-questions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEanesthetic-questions--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>anesthetic-questions/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEanesthetic-questions--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEanesthetic-questions--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEanesthetic-questions--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the anesthetic question.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETappointments--appointment_id--questions--question_id--anesthetic-answers">[Anesthetic Answer] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointments--appointment_id--questions--question_id--anesthetic-answers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointments/1/questions/nobis/anesthetic-answers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1/questions/nobis/anesthetic-answers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointments--appointment_id--questions--question_id--anesthetic-answers">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointments--appointment_id--questions--question_id--anesthetic-answers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointments--appointment_id--questions--question_id--anesthetic-answers"></code></pre>
</span>
<span id="execution-error-GETappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointments--appointment_id--questions--question_id--anesthetic-answers"></code></pre>
</span>
<form id="form-GETappointments--appointment_id--questions--question_id--anesthetic-answers" data-method="GET"
      data-path="appointments/{appointment_id}/questions/{question_id}/anesthetic-answers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointments--appointment_id--questions--question_id--anesthetic-answers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointments--appointment_id--questions--question_id--anesthetic-answers"
                    onclick="tryItOut('GETappointments--appointment_id--questions--question_id--anesthetic-answers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointments--appointment_id--questions--question_id--anesthetic-answers"
                    onclick="cancelTryOut('GETappointments--appointment_id--questions--question_id--anesthetic-answers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointments/{appointment_id}/questions/{question_id}/anesthetic-answers</code></b>
        </p>
                <p>
            <label id="auth-GETappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointments--appointment_id--questions--question_id--anesthetic-answers"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="GETappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    <p>
                <b><code>question_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question_id"
               data-endpoint="GETappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="nobis"
               data-component="url" hidden>
    <br>
<p>The ID of the question.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTappointments--appointment_id--questions--question_id--anesthetic-answers">[Anesthetic Answer] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointments--appointment_id--questions--question_id--anesthetic-answers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointments/1/questions/tenetur/anesthetic-answers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 0,
    \"question_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1/questions/tenetur/anesthetic-answers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 0,
    "question_id": 0
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointments--appointment_id--questions--question_id--anesthetic-answers">
</span>
<span id="execution-results-POSTappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointments--appointment_id--questions--question_id--anesthetic-answers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointments--appointment_id--questions--question_id--anesthetic-answers"></code></pre>
</span>
<span id="execution-error-POSTappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointments--appointment_id--questions--question_id--anesthetic-answers"></code></pre>
</span>
<form id="form-POSTappointments--appointment_id--questions--question_id--anesthetic-answers" data-method="POST"
      data-path="appointments/{appointment_id}/questions/{question_id}/anesthetic-answers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointments--appointment_id--questions--question_id--anesthetic-answers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
                    onclick="tryItOut('POSTappointments--appointment_id--questions--question_id--anesthetic-answers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
                    onclick="cancelTryOut('POSTappointments--appointment_id--questions--question_id--anesthetic-answers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointments/{appointment_id}/questions/{question_id}/anesthetic-answers</code></b>
        </p>
                <p>
            <label id="auth-POSTappointments--appointment_id--questions--question_id--anesthetic-answers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    <p>
                <b><code>question_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question_id"
               data-endpoint="POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="tenetur"
               data-component="url" hidden>
    <br>
<p>The ID of the question.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>question_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="question_id"
               data-endpoint="POSTappointments--appointment_id--questions--question_id--anesthetic-answers"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-">[Anesthetic Answer] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/1/questions/debitis/anesthetic-answers/2" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 0,
    \"question_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1/questions/debitis/anesthetic-answers/2"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 0,
    "question_id": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
</span>
<span id="execution-results-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></code></pre>
</span>
<span id="execution-error-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></code></pre>
</span>
<form id="form-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-" data-method="PUT"
      data-path="appointments/{appointment_id}/questions/{question_id}/anesthetic-answers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                    onclick="tryItOut('PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                    onclick="cancelTryOut('PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/{appointment_id}/questions/{question_id}/anesthetic-answers/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>appointments/{appointment_id}/questions/{question_id}/anesthetic-answers/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    <p>
                <b><code>question_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question_id"
               data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="debitis"
               data-component="url" hidden>
    <br>
<p>The ID of the question.</p>
            </p>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="2"
               data-component="url" hidden>
    <br>
<p>The ID of the anesthetic answer.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>question_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="question_id"
               data-endpoint="PUTappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-">[Anesthetic Answer] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/appointments/1/questions/veniam/anesthetic-answers/3" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1/questions/veniam/anesthetic-answers/3"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-">
</span>
<span id="execution-results-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></code></pre>
</span>
<span id="execution-error-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"></code></pre>
</span>
<form id="form-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-" data-method="DELETE"
      data-path="appointments/{appointment_id}/questions/{question_id}/anesthetic-answers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                    onclick="tryItOut('DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                    onclick="cancelTryOut('DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>appointments/{appointment_id}/questions/{question_id}/anesthetic-answers/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    <p>
                <b><code>question_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question_id"
               data-endpoint="DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="veniam"
               data-component="url" hidden>
    <br>
<p>The ID of the question.</p>
            </p>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEappointments--appointment_id--questions--question_id--anesthetic-answers--id-"
               value="3"
               data-component="url" hidden>
    <br>
<p>The ID of the anesthetic answer.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETemployees">[Employee] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETemployees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/employees" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/employees"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETemployees">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETemployees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETemployees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETemployees"></code></pre>
</span>
<span id="execution-error-GETemployees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETemployees"></code></pre>
</span>
<form id="form-GETemployees" data-method="GET"
      data-path="employees"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETemployees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETemployees"
                    onclick="tryItOut('GETemployees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETemployees"
                    onclick="cancelTryOut('GETemployees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETemployees" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>employees</code></b>
        </p>
                <p>
            <label id="auth-GETemployees" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETemployees"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTemployees">[Employee] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTemployees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/employees" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"\",
    \"username\": \"\",
    \"email\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/employees"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "",
    "username": "",
    "email": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTemployees">
</span>
<span id="execution-results-POSTemployees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTemployees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTemployees"></code></pre>
</span>
<span id="execution-error-POSTemployees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTemployees"></code></pre>
</span>
<form id="form-POSTemployees" data-method="POST"
      data-path="employees"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTemployees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTemployees"
                    onclick="tryItOut('POSTemployees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTemployees"
                    onclick="cancelTryOut('POSTemployees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTemployees" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>employees</code></b>
        </p>
                <p>
            <label id="auth-POSTemployees" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTemployees"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="type"
               data-endpoint="POSTemployees"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="POSTemployees"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTemployees"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTemployees--id-">[Employee] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTemployees--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/employees/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"\",
    \"username\": \"\",
    \"email\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/employees/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "",
    "username": "",
    "email": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTemployees--id-">
</span>
<span id="execution-results-PUTemployees--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTemployees--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTemployees--id-"></code></pre>
</span>
<span id="execution-error-PUTemployees--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTemployees--id-"></code></pre>
</span>
<form id="form-PUTemployees--id-" data-method="PUT"
      data-path="employees/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTemployees--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTemployees--id-"
                    onclick="tryItOut('PUTemployees--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTemployees--id-"
                    onclick="cancelTryOut('PUTemployees--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTemployees--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>employees/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>employees/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTemployees--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTemployees--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTemployees--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the employee.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="type"
               data-endpoint="PUTemployees--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>username</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="username"
               data-endpoint="PUTemployees--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTemployees--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid email address. Must not be greater than 100 characters.</p>
        </p>
        </form>

            <h2 id="endpoints-DELETEemployees--id-">[Employee] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEemployees--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/employees/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/employees/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEemployees--id-">
</span>
<span id="execution-results-DELETEemployees--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEemployees--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEemployees--id-"></code></pre>
</span>
<span id="execution-error-DELETEemployees--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEemployees--id-"></code></pre>
</span>
<form id="form-DELETEemployees--id-" data-method="DELETE"
      data-path="employees/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEemployees--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEemployees--id-"
                    onclick="tryItOut('DELETEemployees--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEemployees--id-"
                    onclick="cancelTryOut('DELETEemployees--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEemployees--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>employees/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEemployees--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEemployees--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEemployees--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the employee.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETspecialists">[Specialist] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETspecialists">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/specialists" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/specialists"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETspecialists">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETspecialists" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETspecialists"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETspecialists"></code></pre>
</span>
<span id="execution-error-GETspecialists" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETspecialists"></code></pre>
</span>
<form id="form-GETspecialists" data-method="GET"
      data-path="specialists"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETspecialists', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETspecialists"
                    onclick="tryItOut('GETspecialists');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETspecialists"
                    onclick="cancelTryOut('GETspecialists');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETspecialists" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>specialists</code></b>
        </p>
                <p>
            <label id="auth-GETspecialists" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETspecialists"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTspecialists">[Specialist] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTspecialists">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/specialists" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"employee_id\": 0,
    \"anesthetist_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/specialists"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "employee_id": 0,
    "anesthetist_id": 0
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTspecialists">
</span>
<span id="execution-results-POSTspecialists" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTspecialists"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTspecialists"></code></pre>
</span>
<span id="execution-error-POSTspecialists" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTspecialists"></code></pre>
</span>
<form id="form-POSTspecialists" data-method="POST"
      data-path="specialists"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTspecialists', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTspecialists"
                    onclick="tryItOut('POSTspecialists');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTspecialists"
                    onclick="cancelTryOut('POSTspecialists');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTspecialists" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>specialists</code></b>
        </p>
                <p>
            <label id="auth-POSTspecialists" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTspecialists"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>employee_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="employee_id"
               data-endpoint="POSTspecialists"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="anesthetist_id"
               data-endpoint="POSTspecialists"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTspecialists--id-">[Specialist] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTspecialists--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/specialists/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"employee_id\": 0,
    \"anesthetist_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/specialists/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "employee_id": 0,
    "anesthetist_id": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTspecialists--id-">
</span>
<span id="execution-results-PUTspecialists--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTspecialists--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTspecialists--id-"></code></pre>
</span>
<span id="execution-error-PUTspecialists--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTspecialists--id-"></code></pre>
</span>
<form id="form-PUTspecialists--id-" data-method="PUT"
      data-path="specialists/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTspecialists--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTspecialists--id-"
                    onclick="tryItOut('PUTspecialists--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTspecialists--id-"
                    onclick="cancelTryOut('PUTspecialists--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTspecialists--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>specialists/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>specialists/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTspecialists--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTspecialists--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTspecialists--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the specialist.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>employee_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="employee_id"
               data-endpoint="PUTspecialists--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="anesthetist_id"
               data-endpoint="PUTspecialists--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEspecialists--id-">[Specialist] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEspecialists--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/specialists/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/specialists/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEspecialists--id-">
</span>
<span id="execution-results-DELETEspecialists--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEspecialists--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEspecialists--id-"></code></pre>
</span>
<span id="execution-error-DELETEspecialists--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEspecialists--id-"></code></pre>
</span>
<form id="form-DELETEspecialists--id-" data-method="DELETE"
      data-path="specialists/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEspecialists--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEspecialists--id-"
                    onclick="tryItOut('DELETEspecialists--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEspecialists--id-"
                    onclick="cancelTryOut('DELETEspecialists--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEspecialists--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>specialists/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEspecialists--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEspecialists--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEspecialists--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the specialist.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETemployee-roles">[User&#039;s Role] - Employee Role List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETemployee-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/employee-roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/employee-roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETemployee-roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETemployee-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETemployee-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETemployee-roles"></code></pre>
</span>
<span id="execution-error-GETemployee-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETemployee-roles"></code></pre>
</span>
<form id="form-GETemployee-roles" data-method="GET"
      data-path="employee-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETemployee-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETemployee-roles"
                    onclick="tryItOut('GETemployee-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETemployee-roles"
                    onclick="cancelTryOut('GETemployee-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETemployee-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>employee-roles</code></b>
        </p>
                <p>
            <label id="auth-GETemployee-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETemployee-roles"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETpatient-recalls">[Patient Recall] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpatient-recalls">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patient-recalls" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-recalls"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatient-recalls">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatient-recalls" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatient-recalls"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatient-recalls"></code></pre>
</span>
<span id="execution-error-GETpatient-recalls" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatient-recalls"></code></pre>
</span>
<form id="form-GETpatient-recalls" data-method="GET"
      data-path="patient-recalls"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatient-recalls', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatient-recalls"
                    onclick="tryItOut('GETpatient-recalls');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatient-recalls"
                    onclick="cancelTryOut('GETpatient-recalls');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatient-recalls" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patient-recalls</code></b>
        </p>
                <p>
            <label id="auth-GETpatient-recalls" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatient-recalls"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTpatient-recalls">[Patient Recall] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-recalls">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-recalls" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"organization_id\": 0,
    \"time_frame\": 0,
    \"reason\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-recalls"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "organization_id": 0,
    "time_frame": 0,
    "reason": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-recalls">
</span>
<span id="execution-results-POSTpatient-recalls" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-recalls"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-recalls"></code></pre>
</span>
<span id="execution-error-POSTpatient-recalls" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-recalls"></code></pre>
</span>
<form id="form-POSTpatient-recalls" data-method="POST"
      data-path="patient-recalls"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-recalls', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-recalls"
                    onclick="tryItOut('POSTpatient-recalls');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-recalls"
                    onclick="cancelTryOut('POSTpatient-recalls');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-recalls" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-recalls</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-recalls" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-recalls"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-recalls"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>organization_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="organization_id"
               data-endpoint="POSTpatient-recalls"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>time_frame</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="time_frame"
               data-endpoint="POSTpatient-recalls"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>reason</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="reason"
               data-endpoint="POSTpatient-recalls"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpatient-recalls--id-">[Patient Recall] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatient-recalls--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patient-recalls/5" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"organization_id\": 0,
    \"time_frame\": 0,
    \"reason\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-recalls/5"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "organization_id": 0,
    "time_frame": 0,
    "reason": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatient-recalls--id-">
</span>
<span id="execution-results-PUTpatient-recalls--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatient-recalls--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatient-recalls--id-"></code></pre>
</span>
<span id="execution-error-PUTpatient-recalls--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatient-recalls--id-"></code></pre>
</span>
<form id="form-PUTpatient-recalls--id-" data-method="PUT"
      data-path="patient-recalls/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatient-recalls--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatient-recalls--id-"
                    onclick="tryItOut('PUTpatient-recalls--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatient-recalls--id-"
                    onclick="cancelTryOut('PUTpatient-recalls--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatient-recalls--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patient-recalls/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patient-recalls/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatient-recalls--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatient-recalls--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatient-recalls--id-"
               value="5"
               data-component="url" hidden>
    <br>
<p>The ID of the patient recall.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="PUTpatient-recalls--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>organization_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="organization_id"
               data-endpoint="PUTpatient-recalls--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>time_frame</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="time_frame"
               data-endpoint="PUTpatient-recalls--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>reason</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="reason"
               data-endpoint="PUTpatient-recalls--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatient-recalls--id-">[Patient Recall] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatient-recalls--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patient-recalls/11" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-recalls/11"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatient-recalls--id-">
</span>
<span id="execution-results-DELETEpatient-recalls--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatient-recalls--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatient-recalls--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatient-recalls--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatient-recalls--id-"></code></pre>
</span>
<form id="form-DELETEpatient-recalls--id-" data-method="DELETE"
      data-path="patient-recalls/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatient-recalls--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatient-recalls--id-"
                    onclick="tryItOut('DELETEpatient-recalls--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatient-recalls--id-"
                    onclick="cancelTryOut('DELETEpatient-recalls--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatient-recalls--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patient-recalls/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatient-recalls--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatient-recalls--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatient-recalls--id-"
               value="11"
               data-component="url" hidden>
    <br>
<p>The ID of the patient recall.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETreport-templates">[Report Template] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETreport-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/report-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/report-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETreport-templates">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETreport-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETreport-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETreport-templates"></code></pre>
</span>
<span id="execution-error-GETreport-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreport-templates"></code></pre>
</span>
<form id="form-GETreport-templates" data-method="GET"
      data-path="report-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETreport-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETreport-templates"
                    onclick="tryItOut('GETreport-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETreport-templates"
                    onclick="cancelTryOut('GETreport-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETreport-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>report-templates</code></b>
        </p>
                <p>
            <label id="auth-GETreport-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETreport-templates"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTreport-templates">[Report Template] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTreport-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/report-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/report-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTreport-templates">
</span>
<span id="execution-results-POSTreport-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTreport-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTreport-templates"></code></pre>
</span>
<span id="execution-error-POSTreport-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTreport-templates"></code></pre>
</span>
<form id="form-POSTreport-templates" data-method="POST"
      data-path="report-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTreport-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTreport-templates"
                    onclick="tryItOut('POSTreport-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTreport-templates"
                    onclick="cancelTryOut('POSTreport-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTreport-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>report-templates</code></b>
        </p>
                <p>
            <label id="auth-POSTreport-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTreport-templates"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTreport-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTreport-templates--id-">[Report Template] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTreport-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/report-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/report-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTreport-templates--id-">
</span>
<span id="execution-results-PUTreport-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTreport-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTreport-templates--id-"></code></pre>
</span>
<span id="execution-error-PUTreport-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTreport-templates--id-"></code></pre>
</span>
<form id="form-PUTreport-templates--id-" data-method="PUT"
      data-path="report-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTreport-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTreport-templates--id-"
                    onclick="tryItOut('PUTreport-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTreport-templates--id-"
                    onclick="cancelTryOut('PUTreport-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTreport-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>report-templates/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>report-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTreport-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTreport-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTreport-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the report template.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTreport-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEreport-templates--id-">[Report Template] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEreport-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/report-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/report-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEreport-templates--id-">
</span>
<span id="execution-results-DELETEreport-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEreport-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEreport-templates--id-"></code></pre>
</span>
<span id="execution-error-DELETEreport-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEreport-templates--id-"></code></pre>
</span>
<form id="form-DELETEreport-templates--id-" data-method="DELETE"
      data-path="report-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEreport-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEreport-templates--id-"
                    onclick="tryItOut('DELETEreport-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEreport-templates--id-"
                    onclick="cancelTryOut('DELETEreport-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEreport-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>report-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEreport-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEreport-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEreport-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the report template.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETpre-admission-sections">[Pre Admission] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpre-admission-sections">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/pre-admission-sections" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pre-admission-sections"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpre-admission-sections">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpre-admission-sections" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpre-admission-sections"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpre-admission-sections"></code></pre>
</span>
<span id="execution-error-GETpre-admission-sections" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpre-admission-sections"></code></pre>
</span>
<form id="form-GETpre-admission-sections" data-method="GET"
      data-path="pre-admission-sections"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpre-admission-sections', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpre-admission-sections"
                    onclick="tryItOut('GETpre-admission-sections');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpre-admission-sections"
                    onclick="cancelTryOut('GETpre-admission-sections');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpre-admission-sections" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>pre-admission-sections</code></b>
        </p>
                <p>
            <label id="auth-GETpre-admission-sections" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpre-admission-sections"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTpre-admission-sections">[Pre Admission] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpre-admission-sections">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/pre-admission-sections" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pre-admission-sections"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpre-admission-sections">
</span>
<span id="execution-results-POSTpre-admission-sections" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpre-admission-sections"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpre-admission-sections"></code></pre>
</span>
<span id="execution-error-POSTpre-admission-sections" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpre-admission-sections"></code></pre>
</span>
<form id="form-POSTpre-admission-sections" data-method="POST"
      data-path="pre-admission-sections"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpre-admission-sections', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpre-admission-sections"
                    onclick="tryItOut('POSTpre-admission-sections');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpre-admission-sections"
                    onclick="cancelTryOut('POSTpre-admission-sections');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpre-admission-sections" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>pre-admission-sections</code></b>
        </p>
                <p>
            <label id="auth-POSTpre-admission-sections" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpre-admission-sections"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTpre-admission-sections"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpre-admission-sections--id-">[Pre Admission] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpre-admission-sections--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/pre-admission-sections/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pre-admission-sections/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpre-admission-sections--id-">
</span>
<span id="execution-results-PUTpre-admission-sections--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpre-admission-sections--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpre-admission-sections--id-"></code></pre>
</span>
<span id="execution-error-PUTpre-admission-sections--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpre-admission-sections--id-"></code></pre>
</span>
<form id="form-PUTpre-admission-sections--id-" data-method="PUT"
      data-path="pre-admission-sections/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpre-admission-sections--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpre-admission-sections--id-"
                    onclick="tryItOut('PUTpre-admission-sections--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpre-admission-sections--id-"
                    onclick="cancelTryOut('PUTpre-admission-sections--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpre-admission-sections--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>pre-admission-sections/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>pre-admission-sections/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpre-admission-sections--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpre-admission-sections--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpre-admission-sections--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the pre admission section.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTpre-admission-sections--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpre-admission-sections--id-">[Pre Admission] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpre-admission-sections--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/pre-admission-sections/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pre-admission-sections/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpre-admission-sections--id-">
</span>
<span id="execution-results-DELETEpre-admission-sections--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpre-admission-sections--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpre-admission-sections--id-"></code></pre>
</span>
<span id="execution-error-DELETEpre-admission-sections--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpre-admission-sections--id-"></code></pre>
</span>
<form id="form-DELETEpre-admission-sections--id-" data-method="DELETE"
      data-path="pre-admission-sections/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpre-admission-sections--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpre-admission-sections--id-"
                    onclick="tryItOut('DELETEpre-admission-sections--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpre-admission-sections--id-"
                    onclick="cancelTryOut('DELETEpre-admission-sections--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpre-admission-sections--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>pre-admission-sections/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpre-admission-sections--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpre-admission-sections--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpre-admission-sections--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the pre admission section.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTupdate-pre-admission-consent">[Pre Admission] - Update Consent</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTupdate-pre-admission-consent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/update-pre-admission-consent" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"text\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/update-pre-admission-consent"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTupdate-pre-admission-consent">
</span>
<span id="execution-results-POSTupdate-pre-admission-consent" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTupdate-pre-admission-consent"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTupdate-pre-admission-consent"></code></pre>
</span>
<span id="execution-error-POSTupdate-pre-admission-consent" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTupdate-pre-admission-consent"></code></pre>
</span>
<form id="form-POSTupdate-pre-admission-consent" data-method="POST"
      data-path="update-pre-admission-consent"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTupdate-pre-admission-consent', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTupdate-pre-admission-consent"
                    onclick="tryItOut('POSTupdate-pre-admission-consent');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTupdate-pre-admission-consent"
                    onclick="cancelTryOut('POSTupdate-pre-admission-consent');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTupdate-pre-admission-consent" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>update-pre-admission-consent</code></b>
        </p>
                <p>
            <label id="auth-POSTupdate-pre-admission-consent" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTupdate-pre-admission-consent"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>text</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="text"
               data-endpoint="POSTupdate-pre-admission-consent"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETget-pre-admission-consent">[Pre Admission] - Get Consent</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETget-pre-admission-consent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/get-pre-admission-consent" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/get-pre-admission-consent"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETget-pre-admission-consent">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETget-pre-admission-consent" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETget-pre-admission-consent"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETget-pre-admission-consent"></code></pre>
</span>
<span id="execution-error-GETget-pre-admission-consent" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETget-pre-admission-consent"></code></pre>
</span>
<form id="form-GETget-pre-admission-consent" data-method="GET"
      data-path="get-pre-admission-consent"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETget-pre-admission-consent', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETget-pre-admission-consent"
                    onclick="tryItOut('GETget-pre-admission-consent');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETget-pre-admission-consent"
                    onclick="cancelTryOut('GETget-pre-admission-consent');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETget-pre-admission-consent" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>get-pre-admission-consent</code></b>
        </p>
                <p>
            <label id="auth-GETget-pre-admission-consent" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETget-pre-admission-consent"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTnotification-test">[Organization] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTnotification-test">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/notification-test" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/notification-test"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTnotification-test">
</span>
<span id="execution-results-POSTnotification-test" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTnotification-test"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTnotification-test"></code></pre>
</span>
<span id="execution-error-POSTnotification-test" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTnotification-test"></code></pre>
</span>
<form id="form-POSTnotification-test" data-method="POST"
      data-path="notification-test"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTnotification-test', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTnotification-test"
                    onclick="tryItOut('POSTnotification-test');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTnotification-test"
                    onclick="cancelTryOut('POSTnotification-test');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTnotification-test" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>notification-test</code></b>
        </p>
                <p>
            <label id="auth-POSTnotification-test" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTnotification-test"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETpayments">[Payment] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpayments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/payments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpayments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpayments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpayments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpayments"></code></pre>
</span>
<span id="execution-error-GETpayments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpayments"></code></pre>
</span>
<form id="form-GETpayments" data-method="GET"
      data-path="payments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpayments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpayments"
                    onclick="tryItOut('GETpayments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpayments"
                    onclick="cancelTryOut('GETpayments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpayments" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>payments</code></b>
        </p>
                <p>
            <label id="auth-GETpayments" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpayments"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETpayments--appointment_id-">[Payment] - Show</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpayments--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/payments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpayments--appointment_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpayments--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpayments--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpayments--appointment_id-"></code></pre>
</span>
<span id="execution-error-GETpayments--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpayments--appointment_id-"></code></pre>
</span>
<form id="form-GETpayments--appointment_id-" data-method="GET"
      data-path="payments/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpayments--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpayments--appointment_id-"
                    onclick="tryItOut('GETpayments--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpayments--appointment_id-"
                    onclick="cancelTryOut('GETpayments--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpayments--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>payments/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-GETpayments--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpayments--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="GETpayments--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTpayments">[Payment] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpayments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/payments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 0,
    \"amount\": 0,
    \"payment_type\": \"\",
    \"is_deposit\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/payments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 0,
    "amount": 0,
    "payment_type": "",
    "is_deposit": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpayments">
</span>
<span id="execution-results-POSTpayments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpayments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpayments"></code></pre>
</span>
<span id="execution-error-POSTpayments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpayments"></code></pre>
</span>
<form id="form-POSTpayments" data-method="POST"
      data-path="payments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpayments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpayments"
                    onclick="tryItOut('POSTpayments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpayments"
                    onclick="cancelTryOut('POSTpayments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpayments" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>payments</code></b>
        </p>
                <p>
            <label id="auth-POSTpayments" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpayments"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpayments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>amount</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="amount"
               data-endpoint="POSTpayments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>payment_type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="payment_type"
               data-endpoint="POSTpayments"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>is_deposit</code></b>&nbsp;&nbsp;<small>boolean</small>  &nbsp;
                <label data-endpoint="POSTpayments" hidden>
            <input type="radio" name="is_deposit"
                   value="true"
                   data-endpoint="POSTpayments"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="POSTpayments" hidden>
            <input type="radio" name="is_deposit"
                   value="false"
                   data-endpoint="POSTpayments"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETclinics--clinic_id--rooms">[Room] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETclinics--clinic_id--rooms">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/clinics/1/rooms" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1/rooms"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETclinics--clinic_id--rooms">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETclinics--clinic_id--rooms" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETclinics--clinic_id--rooms"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETclinics--clinic_id--rooms"></code></pre>
</span>
<span id="execution-error-GETclinics--clinic_id--rooms" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETclinics--clinic_id--rooms"></code></pre>
</span>
<form id="form-GETclinics--clinic_id--rooms" data-method="GET"
      data-path="clinics/{clinic_id}/rooms"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETclinics--clinic_id--rooms', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETclinics--clinic_id--rooms"
                    onclick="tryItOut('GETclinics--clinic_id--rooms');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETclinics--clinic_id--rooms"
                    onclick="cancelTryOut('GETclinics--clinic_id--rooms');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETclinics--clinic_id--rooms" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>clinics/{clinic_id}/rooms</code></b>
        </p>
                <p>
            <label id="auth-GETclinics--clinic_id--rooms" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETclinics--clinic_id--rooms"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="GETclinics--clinic_id--rooms"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTclinics--clinic_id--rooms">[Room] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTclinics--clinic_id--rooms">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/clinics/1/rooms" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"clinic_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1/rooms"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "clinic_id": 0
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTclinics--clinic_id--rooms">
</span>
<span id="execution-results-POSTclinics--clinic_id--rooms" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTclinics--clinic_id--rooms"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTclinics--clinic_id--rooms"></code></pre>
</span>
<span id="execution-error-POSTclinics--clinic_id--rooms" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTclinics--clinic_id--rooms"></code></pre>
</span>
<form id="form-POSTclinics--clinic_id--rooms" data-method="POST"
      data-path="clinics/{clinic_id}/rooms"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTclinics--clinic_id--rooms', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTclinics--clinic_id--rooms"
                    onclick="tryItOut('POSTclinics--clinic_id--rooms');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTclinics--clinic_id--rooms"
                    onclick="cancelTryOut('POSTclinics--clinic_id--rooms');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTclinics--clinic_id--rooms" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>clinics/{clinic_id}/rooms</code></b>
        </p>
                <p>
            <label id="auth-POSTclinics--clinic_id--rooms" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTclinics--clinic_id--rooms"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="POSTclinics--clinic_id--rooms"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTclinics--clinic_id--rooms"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="POSTclinics--clinic_id--rooms"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTclinics--clinic_id--rooms--id-">[Room] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTclinics--clinic_id--rooms--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/clinics/1/rooms/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"\",
    \"clinic_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1/rooms/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "",
    "clinic_id": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTclinics--clinic_id--rooms--id-">
</span>
<span id="execution-results-PUTclinics--clinic_id--rooms--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTclinics--clinic_id--rooms--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTclinics--clinic_id--rooms--id-"></code></pre>
</span>
<span id="execution-error-PUTclinics--clinic_id--rooms--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTclinics--clinic_id--rooms--id-"></code></pre>
</span>
<form id="form-PUTclinics--clinic_id--rooms--id-" data-method="PUT"
      data-path="clinics/{clinic_id}/rooms/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTclinics--clinic_id--rooms--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTclinics--clinic_id--rooms--id-"
                    onclick="tryItOut('PUTclinics--clinic_id--rooms--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTclinics--clinic_id--rooms--id-"
                    onclick="cancelTryOut('PUTclinics--clinic_id--rooms--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTclinics--clinic_id--rooms--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>clinics/{clinic_id}/rooms/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>clinics/{clinic_id}/rooms/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTclinics--clinic_id--rooms--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTclinics--clinic_id--rooms--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="PUTclinics--clinic_id--rooms--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTclinics--clinic_id--rooms--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the room.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTclinics--clinic_id--rooms--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="PUTclinics--clinic_id--rooms--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEclinics--clinic_id--rooms--id-">[Room] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEclinics--clinic_id--rooms--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/clinics/1/rooms/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/clinics/1/rooms/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEclinics--clinic_id--rooms--id-">
</span>
<span id="execution-results-DELETEclinics--clinic_id--rooms--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEclinics--clinic_id--rooms--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEclinics--clinic_id--rooms--id-"></code></pre>
</span>
<span id="execution-error-DELETEclinics--clinic_id--rooms--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEclinics--clinic_id--rooms--id-"></code></pre>
</span>
<form id="form-DELETEclinics--clinic_id--rooms--id-" data-method="DELETE"
      data-path="clinics/{clinic_id}/rooms/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEclinics--clinic_id--rooms--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEclinics--clinic_id--rooms--id-"
                    onclick="tryItOut('DELETEclinics--clinic_id--rooms--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEclinics--clinic_id--rooms--id-"
                    onclick="cancelTryOut('DELETEclinics--clinic_id--rooms--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEclinics--clinic_id--rooms--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>clinics/{clinic_id}/rooms/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEclinics--clinic_id--rooms--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEclinics--clinic_id--rooms--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="DELETEclinics--clinic_id--rooms--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the clinic.</p>
            </p>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEclinics--clinic_id--rooms--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the room.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETappointments">Display a listing of the resource.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointments"></code></pre>
</span>
<span id="execution-error-GETappointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointments"></code></pre>
</span>
<form id="form-GETappointments" data-method="GET"
      data-path="appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointments"
                    onclick="tryItOut('GETappointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointments"
                    onclick="cancelTryOut('GETappointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointments" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointments</code></b>
        </p>
                <p>
            <label id="auth-GETappointments" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointments"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTappointments">Store a newly created resource in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTappointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/appointments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"clinic_id\": 0,
    \"appointment_type_id\": 0,
    \"primary_pathologist_id\": 0,
    \"specialist_id\": 0,
    \"anesthetist_id\": 0,
    \"date\": \"\",
    \"skip_coding\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "clinic_id": 0,
    "appointment_type_id": 0,
    "primary_pathologist_id": 0,
    "specialist_id": 0,
    "anesthetist_id": 0,
    "date": "",
    "skip_coding": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTappointments">
</span>
<span id="execution-results-POSTappointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTappointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTappointments"></code></pre>
</span>
<span id="execution-error-POSTappointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTappointments"></code></pre>
</span>
<form id="form-POSTappointments" data-method="POST"
      data-path="appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTappointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTappointments"
                    onclick="tryItOut('POSTappointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTappointments"
                    onclick="cancelTryOut('POSTappointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTappointments" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>appointments</code></b>
        </p>
                <p>
            <label id="auth-POSTappointments" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTappointments"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="POSTappointments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_type_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="appointment_type_id"
               data-endpoint="POSTappointments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>primary_pathologist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="primary_pathologist_id"
               data-endpoint="POSTappointments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTappointments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="anesthetist_id"
               data-endpoint="POSTappointments"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="POSTappointments"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>skip_coding</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
                <label data-endpoint="POSTappointments" hidden>
            <input type="radio" name="skip_coding"
                   value="true"
                   data-endpoint="POSTappointments"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="POSTappointments" hidden>
            <input type="radio" name="skip_coding"
                   value="false"
                   data-endpoint="POSTappointments"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETappointments--id-">GET appointments/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointments--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointments--id-"></code></pre>
</span>
<span id="execution-error-GETappointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointments--id-"></code></pre>
</span>
<form id="form-GETappointments--id-" data-method="GET"
      data-path="appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointments--id-"
                    onclick="tryItOut('GETappointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointments--id-"
                    onclick="cancelTryOut('GETappointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointments--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointments/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETappointments--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointments--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETappointments--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTappointments--id-">Update the specified resource in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"clinic_id\": 0,
    \"appointment_type_id\": 0,
    \"primary_pathologist_id\": 0,
    \"specialist_id\": 0,
    \"anesthetist_id\": 0,
    \"date\": \"\",
    \"skip_coding\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "clinic_id": 0,
    "appointment_type_id": 0,
    "primary_pathologist_id": 0,
    "specialist_id": 0,
    "anesthetist_id": 0,
    "date": "",
    "skip_coding": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments--id-">
</span>
<span id="execution-results-PUTappointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments--id-"></code></pre>
</span>
<span id="execution-error-PUTappointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments--id-"></code></pre>
</span>
<form id="form-PUTappointments--id-" data-method="PUT"
      data-path="appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments--id-"
                    onclick="tryItOut('PUTappointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments--id-"
                    onclick="cancelTryOut('PUTappointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>appointments/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTappointments--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="PUTappointments--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_type_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="appointment_type_id"
               data-endpoint="PUTappointments--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>primary_pathologist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="primary_pathologist_id"
               data-endpoint="PUTappointments--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="PUTappointments--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="anesthetist_id"
               data-endpoint="PUTappointments--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="PUTappointments--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>skip_coding</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
                <label data-endpoint="PUTappointments--id-" hidden>
            <input type="radio" name="skip_coding"
                   value="true"
                   data-endpoint="PUTappointments--id-"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="PUTappointments--id-" hidden>
            <input type="radio" name="skip_coding"
                   value="false"
                   data-endpoint="PUTappointments--id-"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEappointments--id-">Remove the specified resource from storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEappointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/appointments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEappointments--id-">
</span>
<span id="execution-results-DELETEappointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEappointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEappointments--id-"></code></pre>
</span>
<span id="execution-error-DELETEappointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEappointments--id-"></code></pre>
</span>
<form id="form-DELETEappointments--id-" data-method="DELETE"
      data-path="appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEappointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEappointments--id-"
                    onclick="tryItOut('DELETEappointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEappointments--id-"
                    onclick="cancelTryOut('DELETEappointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEappointments--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>appointments/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEappointments--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEappointments--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEappointments--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETreferring-doctors">[Referring Doctor] - All</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETreferring-doctors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/referring-doctors" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/referring-doctors"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETreferring-doctors">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETreferring-doctors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETreferring-doctors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETreferring-doctors"></code></pre>
</span>
<span id="execution-error-GETreferring-doctors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreferring-doctors"></code></pre>
</span>
<form id="form-GETreferring-doctors" data-method="GET"
      data-path="referring-doctors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETreferring-doctors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETreferring-doctors"
                    onclick="tryItOut('GETreferring-doctors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETreferring-doctors"
                    onclick="cancelTryOut('GETreferring-doctors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETreferring-doctors" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>referring-doctors</code></b>
        </p>
                <p>
            <label id="auth-GETreferring-doctors" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETreferring-doctors"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTreferring-doctors">[Referring Doctor] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTreferring-doctors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/referring-doctors" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"provider_no\": \"\",
    \"title\": \"\",
    \"first_name\": \"\",
    \"last_name\": \"\",
    \"address\": \"\",
    \"street\": \"\",
    \"city\": \"\",
    \"state\": \"\",
    \"country\": \"\",
    \"postcode\": \"\",
    \"phone\": \"\",
    \"fax\": \"\",
    \"mobile\": \"\",
    \"email\": \"\",
    \"practice_name\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/referring-doctors"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "provider_no": "",
    "title": "",
    "first_name": "",
    "last_name": "",
    "address": "",
    "street": "",
    "city": "",
    "state": "",
    "country": "",
    "postcode": "",
    "phone": "",
    "fax": "",
    "mobile": "",
    "email": "",
    "practice_name": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTreferring-doctors">
</span>
<span id="execution-results-POSTreferring-doctors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTreferring-doctors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTreferring-doctors"></code></pre>
</span>
<span id="execution-error-POSTreferring-doctors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTreferring-doctors"></code></pre>
</span>
<form id="form-POSTreferring-doctors" data-method="POST"
      data-path="referring-doctors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTreferring-doctors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTreferring-doctors"
                    onclick="tryItOut('POSTreferring-doctors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTreferring-doctors"
                    onclick="cancelTryOut('POSTreferring-doctors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTreferring-doctors" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>referring-doctors</code></b>
        </p>
                <p>
            <label id="auth-POSTreferring-doctors" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTreferring-doctors"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>provider_no</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="provider_no"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>street</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="street"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>city</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="city"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="state"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>country</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="country"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>postcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="postcode"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="fax"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>mobile</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="mobile"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>practice_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="practice_name"
               data-endpoint="POSTreferring-doctors"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTreferring-doctors--id-">[Referring Doctor] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTreferring-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/referring-doctors/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"provider_no\": \"\",
    \"title\": \"\",
    \"first_name\": \"\",
    \"last_name\": \"\",
    \"address\": \"\",
    \"street\": \"\",
    \"city\": \"\",
    \"state\": \"\",
    \"country\": \"\",
    \"postcode\": \"\",
    \"phone\": \"\",
    \"fax\": \"\",
    \"mobile\": \"\",
    \"email\": \"\",
    \"practice_name\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/referring-doctors/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "provider_no": "",
    "title": "",
    "first_name": "",
    "last_name": "",
    "address": "",
    "street": "",
    "city": "",
    "state": "",
    "country": "",
    "postcode": "",
    "phone": "",
    "fax": "",
    "mobile": "",
    "email": "",
    "practice_name": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTreferring-doctors--id-">
</span>
<span id="execution-results-PUTreferring-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTreferring-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTreferring-doctors--id-"></code></pre>
</span>
<span id="execution-error-PUTreferring-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTreferring-doctors--id-"></code></pre>
</span>
<form id="form-PUTreferring-doctors--id-" data-method="PUT"
      data-path="referring-doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTreferring-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTreferring-doctors--id-"
                    onclick="tryItOut('PUTreferring-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTreferring-doctors--id-"
                    onclick="cancelTryOut('PUTreferring-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTreferring-doctors--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>referring-doctors/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>referring-doctors/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTreferring-doctors--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTreferring-doctors--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTreferring-doctors--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the referring doctor.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>provider_no</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="provider_no"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>street</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="street"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>city</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="city"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="state"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>country</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="country"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>postcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="postcode"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="fax"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>mobile</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="mobile"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>practice_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="practice_name"
               data-endpoint="PUTreferring-doctors--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEreferring-doctors--id-">[Referring Doctor] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEreferring-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/referring-doctors/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/referring-doctors/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEreferring-doctors--id-">
</span>
<span id="execution-results-DELETEreferring-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEreferring-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEreferring-doctors--id-"></code></pre>
</span>
<span id="execution-error-DELETEreferring-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEreferring-doctors--id-"></code></pre>
</span>
<form id="form-DELETEreferring-doctors--id-" data-method="DELETE"
      data-path="referring-doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEreferring-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEreferring-doctors--id-"
                    onclick="tryItOut('DELETEreferring-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEreferring-doctors--id-"
                    onclick="cancelTryOut('DELETEreferring-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEreferring-doctors--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>referring-doctors/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEreferring-doctors--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEreferring-doctors--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEreferring-doctors--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the referring doctor.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETuser-appointments">[User Appointment] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETuser-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/user-appointments" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/user-appointments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETuser-appointments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETuser-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETuser-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETuser-appointments"></code></pre>
</span>
<span id="execution-error-GETuser-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETuser-appointments"></code></pre>
</span>
<form id="form-GETuser-appointments" data-method="GET"
      data-path="user-appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETuser-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETuser-appointments"
                    onclick="tryItOut('GETuser-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETuser-appointments"
                    onclick="cancelTryOut('GETuser-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETuser-appointments" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>user-appointments</code></b>
        </p>
                <p>
            <label id="auth-GETuser-appointments" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETuser-appointments"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-PUTappointments-update_collecting_person--id-">Procedure Approve by Anesthetist</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-update_collecting_person--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/update_collecting_person/et" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/update_collecting_person/et"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-update_collecting_person--id-">
</span>
<span id="execution-results-PUTappointments-update_collecting_person--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-update_collecting_person--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-update_collecting_person--id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-update_collecting_person--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-update_collecting_person--id-"></code></pre>
</span>
<form id="form-PUTappointments-update_collecting_person--id-" data-method="PUT"
      data-path="appointments/update_collecting_person/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-update_collecting_person--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-update_collecting_person--id-"
                    onclick="tryItOut('PUTappointments-update_collecting_person--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-update_collecting_person--id-"
                    onclick="cancelTryOut('PUTappointments-update_collecting_person--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-update_collecting_person--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/update_collecting_person/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-update_collecting_person--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-update_collecting_person--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="PUTappointments-update_collecting_person--id-"
               value="et"
               data-component="url" hidden>
    <br>
<p>The ID of the update collecting person.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTappointments-procedureApprovalStatus--appointment_id-">[Appointment Procedure Approval] - Update Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-procedureApprovalStatus--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/procedureApprovalStatus/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"procedure_approval_status\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/procedureApprovalStatus/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "procedure_approval_status": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-procedureApprovalStatus--appointment_id-">
</span>
<span id="execution-results-PUTappointments-procedureApprovalStatus--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-procedureApprovalStatus--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-procedureApprovalStatus--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-procedureApprovalStatus--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-procedureApprovalStatus--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-procedureApprovalStatus--appointment_id-" data-method="PUT"
      data-path="appointments/procedureApprovalStatus/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-procedureApprovalStatus--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-procedureApprovalStatus--appointment_id-"
                    onclick="tryItOut('PUTappointments-procedureApprovalStatus--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-procedureApprovalStatus--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-procedureApprovalStatus--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-procedureApprovalStatus--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/procedureApprovalStatus/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-procedureApprovalStatus--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-procedureApprovalStatus--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-procedureApprovalStatus--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>procedure_approval_status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="procedure_approval_status"
               data-endpoint="PUTappointments-procedureApprovalStatus--appointment_id-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be one of <code>NOT_APPROVED</code>, <code>APPROVED</code>, or <code>CONSULT_REQUIRED</code>.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTappointments-check-in--appointment_id-">Check In</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-check-in--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/check-in/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/check-in/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-check-in--appointment_id-">
</span>
<span id="execution-results-PUTappointments-check-in--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-check-in--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-check-in--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-check-in--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-check-in--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-check-in--appointment_id-" data-method="PUT"
      data-path="appointments/check-in/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-check-in--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-check-in--appointment_id-"
                    onclick="tryItOut('PUTappointments-check-in--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-check-in--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-check-in--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-check-in--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/check-in/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-check-in--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-check-in--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-check-in--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTappointments-check-out--appointment_id-">Check Out</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-check-out--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/check-out/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/check-out/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-check-out--appointment_id-">
</span>
<span id="execution-results-PUTappointments-check-out--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-check-out--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-check-out--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-check-out--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-check-out--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-check-out--appointment_id-" data-method="PUT"
      data-path="appointments/check-out/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-check-out--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-check-out--appointment_id-"
                    onclick="tryItOut('PUTappointments-check-out--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-check-out--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-check-out--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-check-out--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/check-out/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-check-out--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-check-out--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-check-out--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTappointments-cancel--appointment_id-">Cancel Appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-cancel--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/cancel/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/cancel/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-cancel--appointment_id-">
</span>
<span id="execution-results-PUTappointments-cancel--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-cancel--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-cancel--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-cancel--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-cancel--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-cancel--appointment_id-" data-method="PUT"
      data-path="appointments/cancel/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-cancel--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-cancel--appointment_id-"
                    onclick="tryItOut('PUTappointments-cancel--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-cancel--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-cancel--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-cancel--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/cancel/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-cancel--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-cancel--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-cancel--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTappointments-wait-listed--appointment-">Appointment wait listed</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-wait-listed--appointment-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/wait-listed/sapiente" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/wait-listed/sapiente"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-wait-listed--appointment-">
</span>
<span id="execution-results-PUTappointments-wait-listed--appointment-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-wait-listed--appointment-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-wait-listed--appointment-"></code></pre>
</span>
<span id="execution-error-PUTappointments-wait-listed--appointment-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-wait-listed--appointment-"></code></pre>
</span>
<form id="form-PUTappointments-wait-listed--appointment-" data-method="PUT"
      data-path="appointments/wait-listed/{appointment}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-wait-listed--appointment-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-wait-listed--appointment-"
                    onclick="tryItOut('PUTappointments-wait-listed--appointment-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-wait-listed--appointment-"
                    onclick="cancelTryOut('PUTappointments-wait-listed--appointment-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-wait-listed--appointment-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/wait-listed/{appointment}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-wait-listed--appointment-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-wait-listed--appointment-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="appointment"
               data-endpoint="PUTappointments-wait-listed--appointment-"
               value="sapiente"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-PUTappointment-referrals-update--appointment-">[Organization] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointment-referrals-update--appointment-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointment-referrals/update/quia" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"is_no_referral\": \"\",
    \"referral_date\": \"\",
    \"referral_duration\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment-referrals/update/quia"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "is_no_referral": "",
    "referral_date": "",
    "referral_duration": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointment-referrals-update--appointment-">
</span>
<span id="execution-results-PUTappointment-referrals-update--appointment-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointment-referrals-update--appointment-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointment-referrals-update--appointment-"></code></pre>
</span>
<span id="execution-error-PUTappointment-referrals-update--appointment-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointment-referrals-update--appointment-"></code></pre>
</span>
<form id="form-PUTappointment-referrals-update--appointment-" data-method="PUT"
      data-path="appointment-referrals/update/{appointment}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointment-referrals-update--appointment-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointment-referrals-update--appointment-"
                    onclick="tryItOut('PUTappointment-referrals-update--appointment-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointment-referrals-update--appointment-"
                    onclick="cancelTryOut('PUTappointment-referrals-update--appointment-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointment-referrals-update--appointment-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointment-referrals/update/{appointment}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointment-referrals-update--appointment-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointment-referrals-update--appointment-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="appointment"
               data-endpoint="PUTappointment-referrals-update--appointment-"
               value="quia"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>is_no_referral</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="is_no_referral"
               data-endpoint="PUTappointment-referrals-update--appointment-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>referral_date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="referral_date"
               data-endpoint="PUTappointment-referrals-update--appointment-"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>referral_duration</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="referral_duration"
               data-endpoint="PUTappointment-referrals-update--appointment-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETavailable-slots">Return available time slots</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETavailable-slots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/available-slots" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/available-slots"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETavailable-slots">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETavailable-slots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETavailable-slots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETavailable-slots"></code></pre>
</span>
<span id="execution-error-GETavailable-slots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETavailable-slots"></code></pre>
</span>
<form id="form-GETavailable-slots" data-method="GET"
      data-path="available-slots"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETavailable-slots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETavailable-slots"
                    onclick="tryItOut('GETavailable-slots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETavailable-slots"
                    onclick="cancelTryOut('GETavailable-slots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETavailable-slots" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>available-slots</code></b>
        </p>
                <p>
            <label id="auth-GETavailable-slots" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETavailable-slots"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETwork-hours">[Specialist] - Work Hours By Today</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETwork-hours">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/work-hours" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/work-hours"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETwork-hours">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETwork-hours" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETwork-hours"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETwork-hours"></code></pre>
</span>
<span id="execution-error-GETwork-hours" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETwork-hours"></code></pre>
</span>
<form id="form-GETwork-hours" data-method="GET"
      data-path="work-hours"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETwork-hours', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETwork-hours"
                    onclick="tryItOut('GETwork-hours');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETwork-hours"
                    onclick="cancelTryOut('GETwork-hours');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETwork-hours" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>work-hours</code></b>
        </p>
                <p>
            <label id="auth-GETwork-hours" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETwork-hours"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETwork-hours-by-week">[Specialist] - Work Hours By Week</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETwork-hours-by-week">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/work-hours-by-week" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/work-hours-by-week"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETwork-hours-by-week">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETwork-hours-by-week" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETwork-hours-by-week"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETwork-hours-by-week"></code></pre>
</span>
<span id="execution-error-GETwork-hours-by-week" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETwork-hours-by-week"></code></pre>
</span>
<form id="form-GETwork-hours-by-week" data-method="GET"
      data-path="work-hours-by-week"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETwork-hours-by-week', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETwork-hours-by-week"
                    onclick="tryItOut('GETwork-hours-by-week');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETwork-hours-by-week"
                    onclick="cancelTryOut('GETwork-hours-by-week');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETwork-hours-by-week" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>work-hours-by-week</code></b>
        </p>
                <p>
            <label id="auth-GETwork-hours-by-week" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETwork-hours-by-week"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETanesthetists">[Anesthetist] - List.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETanesthetists">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/anesthetists" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetists"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETanesthetists">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETanesthetists" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETanesthetists"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETanesthetists"></code></pre>
</span>
<span id="execution-error-GETanesthetists" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETanesthetists"></code></pre>
</span>
<form id="form-GETanesthetists" data-method="GET"
      data-path="anesthetists"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETanesthetists', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETanesthetists"
                    onclick="tryItOut('GETanesthetists');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETanesthetists"
                    onclick="cancelTryOut('GETanesthetists');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETanesthetists" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>anesthetists</code></b>
        </p>
                <p>
            <label id="auth-GETanesthetists" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETanesthetists"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTpatient-documents">[Patient Document] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents">
</span>
<span id="execution-results-POSTpatient-documents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents"></code></pre>
</span>
<form id="form-POSTpatient-documents" data-method="POST"
      data-path="patient-documents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents"
                    onclick="tryItOut('POSTpatient-documents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents"
                    onclick="cancelTryOut('POSTpatient-documents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTpatient-documents-upload">[Patient Document] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"document_type\": \"\",
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "document_type": "",
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents-upload">
</span>
<span id="execution-results-POSTpatient-documents-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents-upload"></code></pre>
</span>
<form id="form-POSTpatient-documents-upload" data-method="POST"
      data-path="patient-documents/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents-upload"
                    onclick="tryItOut('POSTpatient-documents-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents-upload"
                    onclick="cancelTryOut('POSTpatient-documents-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents-upload"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-documents-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>document_type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_type"
               data-endpoint="POSTpatient-documents-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-documents-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpatient-documents-letter">[Patient Document Letter] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents-letter">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents-letter" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"to\": 0,
    \"from\": 0,
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-letter"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "to": 0,
    "from": 0,
    "body": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents-letter">
</span>
<span id="execution-results-POSTpatient-documents-letter" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents-letter"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents-letter"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents-letter" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents-letter"></code></pre>
</span>
<form id="form-POSTpatient-documents-letter" data-method="POST"
      data-path="patient-documents-letter"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents-letter', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents-letter"
                    onclick="tryItOut('POSTpatient-documents-letter');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents-letter"
                    onclick="cancelTryOut('POSTpatient-documents-letter');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents-letter" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents-letter</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents-letter" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents-letter"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-documents-letter"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>to</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="to"
               data-endpoint="POSTpatient-documents-letter"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>from</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="from"
               data-endpoint="POSTpatient-documents-letter"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="POSTpatient-documents-letter"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpatient-documents-letter--id-">[Patient Document Letter] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatient-documents-letter--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patient-documents-letter/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"to\": 0,
    \"from\": 0,
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-letter/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "to": 0,
    "from": 0,
    "body": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatient-documents-letter--id-">
</span>
<span id="execution-results-PUTpatient-documents-letter--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatient-documents-letter--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatient-documents-letter--id-"></code></pre>
</span>
<span id="execution-error-PUTpatient-documents-letter--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatient-documents-letter--id-"></code></pre>
</span>
<form id="form-PUTpatient-documents-letter--id-" data-method="PUT"
      data-path="patient-documents-letter/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatient-documents-letter--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatient-documents-letter--id-"
                    onclick="tryItOut('PUTpatient-documents-letter--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatient-documents-letter--id-"
                    onclick="cancelTryOut('PUTpatient-documents-letter--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatient-documents-letter--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patient-documents-letter/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patient-documents-letter/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatient-documents-letter--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatient-documents-letter--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatient-documents-letter--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents letter.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="PUTpatient-documents-letter--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>to</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="to"
               data-endpoint="PUTpatient-documents-letter--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>from</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="from"
               data-endpoint="PUTpatient-documents-letter--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="PUTpatient-documents-letter--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatient-documents-letter--id-">[Patient Document Letter] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatient-documents-letter--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patient-documents-letter/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-letter/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatient-documents-letter--id-">
</span>
<span id="execution-results-DELETEpatient-documents-letter--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatient-documents-letter--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatient-documents-letter--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatient-documents-letter--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatient-documents-letter--id-"></code></pre>
</span>
<form id="form-DELETEpatient-documents-letter--id-" data-method="DELETE"
      data-path="patient-documents-letter/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatient-documents-letter--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatient-documents-letter--id-"
                    onclick="tryItOut('DELETEpatient-documents-letter--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatient-documents-letter--id-"
                    onclick="cancelTryOut('DELETEpatient-documents-letter--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatient-documents-letter--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patient-documents-letter/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatient-documents-letter--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatient-documents-letter--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatient-documents-letter--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents letter.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTpatient-document--patient_id--letter-upload">[Patient Document Letter] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-document--patient_id--letter-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-document/1/letter/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"specialist_id\": 0,
    \"appointment_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-document/1/letter/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "specialist_id": 0,
    "appointment_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-document--patient_id--letter-upload">
</span>
<span id="execution-results-POSTpatient-document--patient_id--letter-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-document--patient_id--letter-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-document--patient_id--letter-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-document--patient_id--letter-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-document--patient_id--letter-upload"></code></pre>
</span>
<form id="form-POSTpatient-document--patient_id--letter-upload" data-method="POST"
      data-path="patient-document/{patient_id}/letter/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-document--patient_id--letter-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-document--patient_id--letter-upload"
                    onclick="tryItOut('POSTpatient-document--patient_id--letter-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-document--patient_id--letter-upload"
                    onclick="cancelTryOut('POSTpatient-document--patient_id--letter-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-document--patient_id--letter-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-document/{patient_id}/letter/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-document--patient_id--letter-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-document--patient_id--letter-upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-document--patient_id--letter-upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-document--patient_id--letter-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-document--patient_id--letter-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-document--patient_id--letter-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-document--patient_id--letter-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpatient-documents-report">[Patient Document Report] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents-report">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents-report" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-report"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "body": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents-report">
</span>
<span id="execution-results-POSTpatient-documents-report" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents-report"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents-report"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents-report" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents-report"></code></pre>
</span>
<form id="form-POSTpatient-documents-report" data-method="POST"
      data-path="patient-documents-report"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents-report', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents-report"
                    onclick="tryItOut('POSTpatient-documents-report');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents-report"
                    onclick="cancelTryOut('POSTpatient-documents-report');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents-report" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents-report</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents-report" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents-report"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-documents-report"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="POSTpatient-documents-report"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpatient-documents-report--id-">[Patient Document Report] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatient-documents-report--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patient-documents-report/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-report/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "body": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatient-documents-report--id-">
</span>
<span id="execution-results-PUTpatient-documents-report--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatient-documents-report--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatient-documents-report--id-"></code></pre>
</span>
<span id="execution-error-PUTpatient-documents-report--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatient-documents-report--id-"></code></pre>
</span>
<form id="form-PUTpatient-documents-report--id-" data-method="PUT"
      data-path="patient-documents-report/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatient-documents-report--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatient-documents-report--id-"
                    onclick="tryItOut('PUTpatient-documents-report--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatient-documents-report--id-"
                    onclick="cancelTryOut('PUTpatient-documents-report--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatient-documents-report--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patient-documents-report/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patient-documents-report/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatient-documents-report--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatient-documents-report--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatient-documents-report--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents report.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="PUTpatient-documents-report--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="PUTpatient-documents-report--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatient-documents-report--id-">[Patient Document Report] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatient-documents-report--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patient-documents-report/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-report/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatient-documents-report--id-">
</span>
<span id="execution-results-DELETEpatient-documents-report--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatient-documents-report--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatient-documents-report--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatient-documents-report--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatient-documents-report--id-"></code></pre>
</span>
<form id="form-DELETEpatient-documents-report--id-" data-method="DELETE"
      data-path="patient-documents-report/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatient-documents-report--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatient-documents-report--id-"
                    onclick="tryItOut('DELETEpatient-documents-report--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatient-documents-report--id-"
                    onclick="cancelTryOut('DELETEpatient-documents-report--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatient-documents-report--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patient-documents-report/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatient-documents-report--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatient-documents-report--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatient-documents-report--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents report.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTpatient-document--patient_id--report-upload">[Patient Document Report] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-document--patient_id--report-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-document/1/report/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"specialist_id\": 0,
    \"appointment_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-document/1/report/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "specialist_id": 0,
    "appointment_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-document--patient_id--report-upload">
</span>
<span id="execution-results-POSTpatient-document--patient_id--report-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-document--patient_id--report-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-document--patient_id--report-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-document--patient_id--report-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-document--patient_id--report-upload"></code></pre>
</span>
<form id="form-POSTpatient-document--patient_id--report-upload" data-method="POST"
      data-path="patient-document/{patient_id}/report/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-document--patient_id--report-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-document--patient_id--report-upload"
                    onclick="tryItOut('POSTpatient-document--patient_id--report-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-document--patient_id--report-upload"
                    onclick="cancelTryOut('POSTpatient-document--patient_id--report-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-document--patient_id--report-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-document/{patient_id}/report/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-document--patient_id--report-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-document--patient_id--report-upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-document--patient_id--report-upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-document--patient_id--report-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-document--patient_id--report-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-document--patient_id--report-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-document--patient_id--report-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpatient-documents-clinical-note">[Patient Document Clinical Note] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents-clinical-note">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents-clinical-note" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 0,
    \"description\": \"\",
    \"diagnosis\": \"\",
    \"clinical_assessment\": \"\",
    \"treatment\": \"\",
    \"history\": \"\",
    \"additional_details\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-clinical-note"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 0,
    "description": "",
    "diagnosis": "",
    "clinical_assessment": "",
    "treatment": "",
    "history": "",
    "additional_details": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents-clinical-note">
</span>
<span id="execution-results-POSTpatient-documents-clinical-note" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents-clinical-note"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents-clinical-note"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents-clinical-note" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents-clinical-note"></code></pre>
</span>
<form id="form-POSTpatient-documents-clinical-note" data-method="POST"
      data-path="patient-documents-clinical-note"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents-clinical-note', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents-clinical-note"
                    onclick="tryItOut('POSTpatient-documents-clinical-note');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents-clinical-note"
                    onclick="cancelTryOut('POSTpatient-documents-clinical-note');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents-clinical-note" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents-clinical-note</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents-clinical-note" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents-clinical-note"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-documents-clinical-note"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>diagnosis</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="diagnosis"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>clinical_assessment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="clinical_assessment"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>treatment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="treatment"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>history</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="history"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>additional_details</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="additional_details"
               data-endpoint="POSTpatient-documents-clinical-note"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpatient-documents-clinical-note--id-">[Patient Document Clinical Note] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatient-documents-clinical-note--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patient-documents-clinical-note/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 5,
    \"description\": \"sit\",
    \"diagnosis\": \"dolor\",
    \"clinical_assessment\": \"vero\",
    \"treatment\": \"soluta\",
    \"history\": \"odio\",
    \"additional_details\": \"velit\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-clinical-note/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 5,
    "description": "sit",
    "diagnosis": "dolor",
    "clinical_assessment": "vero",
    "treatment": "soluta",
    "history": "odio",
    "additional_details": "velit"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatient-documents-clinical-note--id-">
</span>
<span id="execution-results-PUTpatient-documents-clinical-note--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatient-documents-clinical-note--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatient-documents-clinical-note--id-"></code></pre>
</span>
<span id="execution-error-PUTpatient-documents-clinical-note--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatient-documents-clinical-note--id-"></code></pre>
</span>
<form id="form-PUTpatient-documents-clinical-note--id-" data-method="PUT"
      data-path="patient-documents-clinical-note/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatient-documents-clinical-note--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatient-documents-clinical-note--id-"
                    onclick="tryItOut('PUTpatient-documents-clinical-note--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatient-documents-clinical-note--id-"
                    onclick="cancelTryOut('PUTpatient-documents-clinical-note--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatient-documents-clinical-note--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patient-documents-clinical-note/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patient-documents-clinical-note/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatient-documents-clinical-note--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatient-documents-clinical-note--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents clinical note.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="5"
               data-component="body" hidden>
    <br>
<p>Appointment ID.</p>
        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="sit"
               data-component="body" hidden>
    <br>
<p>Description.</p>
        </p>
                <p>
            <b><code>diagnosis</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="diagnosis"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="dolor"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>clinical_assessment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="clinical_assessment"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="vero"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>treatment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="treatment"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="soluta"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>history</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="history"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="odio"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>additional_details</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="additional_details"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="velit"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatient-documents-clinical-note--id-">[Patient Document Clinical Note] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatient-documents-clinical-note--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patient-documents-clinical-note/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-clinical-note/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatient-documents-clinical-note--id-">
</span>
<span id="execution-results-DELETEpatient-documents-clinical-note--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatient-documents-clinical-note--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatient-documents-clinical-note--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatient-documents-clinical-note--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatient-documents-clinical-note--id-"></code></pre>
</span>
<form id="form-DELETEpatient-documents-clinical-note--id-" data-method="DELETE"
      data-path="patient-documents-clinical-note/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatient-documents-clinical-note--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatient-documents-clinical-note--id-"
                    onclick="tryItOut('DELETEpatient-documents-clinical-note--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatient-documents-clinical-note--id-"
                    onclick="cancelTryOut('DELETEpatient-documents-clinical-note--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatient-documents-clinical-note--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patient-documents-clinical-note/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatient-documents-clinical-note--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatient-documents-clinical-note--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatient-documents-clinical-note--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents clinical note.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTpatient-document--patient_id--clinical-note-upload">[Patient Document Clinical Note] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-document--patient_id--clinical-note-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-document/1/clinical-note/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"specialist_id\": 0,
    \"appointment_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-document/1/clinical-note/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "specialist_id": 0,
    "appointment_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-document--patient_id--clinical-note-upload">
</span>
<span id="execution-results-POSTpatient-document--patient_id--clinical-note-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-document--patient_id--clinical-note-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-document--patient_id--clinical-note-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-document--patient_id--clinical-note-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-document--patient_id--clinical-note-upload"></code></pre>
</span>
<form id="form-POSTpatient-document--patient_id--clinical-note-upload" data-method="POST"
      data-path="patient-document/{patient_id}/clinical-note/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-document--patient_id--clinical-note-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-document--patient_id--clinical-note-upload"
                    onclick="tryItOut('POSTpatient-document--patient_id--clinical-note-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-document--patient_id--clinical-note-upload"
                    onclick="cancelTryOut('POSTpatient-document--patient_id--clinical-note-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-document--patient_id--clinical-note-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-document/{patient_id}/clinical-note/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-document--patient_id--clinical-note-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-document--patient_id--clinical-note-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpatient-documents-audio">[Patient Document Audio] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-documents-audio">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-documents-audio" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"specialist_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-audio"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "specialist_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-documents-audio">
</span>
<span id="execution-results-POSTpatient-documents-audio" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-documents-audio"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-documents-audio"></code></pre>
</span>
<span id="execution-error-POSTpatient-documents-audio" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-documents-audio"></code></pre>
</span>
<form id="form-POSTpatient-documents-audio" data-method="POST"
      data-path="patient-documents-audio"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-documents-audio', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-documents-audio"
                    onclick="tryItOut('POSTpatient-documents-audio');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-documents-audio"
                    onclick="cancelTryOut('POSTpatient-documents-audio');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-documents-audio" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-documents-audio</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-documents-audio" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-documents-audio"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-documents-audio"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-documents-audio"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-documents-audio"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTpatient-documents-audio--id-">[Patient Document Audio] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatient-documents-audio--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patient-documents-audio/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 0,
    \"specialist_id\": 0
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-audio/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 0,
    "specialist_id": 0
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatient-documents-audio--id-">
</span>
<span id="execution-results-PUTpatient-documents-audio--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatient-documents-audio--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatient-documents-audio--id-"></code></pre>
</span>
<span id="execution-error-PUTpatient-documents-audio--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatient-documents-audio--id-"></code></pre>
</span>
<form id="form-PUTpatient-documents-audio--id-" data-method="PUT"
      data-path="patient-documents-audio/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatient-documents-audio--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatient-documents-audio--id-"
                    onclick="tryItOut('PUTpatient-documents-audio--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatient-documents-audio--id-"
                    onclick="cancelTryOut('PUTpatient-documents-audio--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatient-documents-audio--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patient-documents-audio/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patient-documents-audio/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatient-documents-audio--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatient-documents-audio--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatient-documents-audio--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents audio.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="PUTpatient-documents-audio--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="PUTpatient-documents-audio--id-"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatient-documents-audio--id-">[Patient Document Audio] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatient-documents-audio--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patient-documents-audio/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-documents-audio/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatient-documents-audio--id-">
</span>
<span id="execution-results-DELETEpatient-documents-audio--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatient-documents-audio--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatient-documents-audio--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatient-documents-audio--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatient-documents-audio--id-"></code></pre>
</span>
<form id="form-DELETEpatient-documents-audio--id-" data-method="DELETE"
      data-path="patient-documents-audio/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatient-documents-audio--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatient-documents-audio--id-"
                    onclick="tryItOut('DELETEpatient-documents-audio--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatient-documents-audio--id-"
                    onclick="cancelTryOut('DELETEpatient-documents-audio--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatient-documents-audio--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patient-documents-audio/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatient-documents-audio--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatient-documents-audio--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatient-documents-audio--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient documents audio.</p>
            </p>
                    </form>

            <h2 id="endpoints-POSTpatient-document--patient_id--audio-upload">[Patient Document Audio] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-document--patient_id--audio-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-document/1/audio/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"specialist_id\": 0,
    \"appointment_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-document/1/audio/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "specialist_id": 0,
    "appointment_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-document--patient_id--audio-upload">
</span>
<span id="execution-results-POSTpatient-document--patient_id--audio-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-document--patient_id--audio-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-document--patient_id--audio-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-document--patient_id--audio-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-document--patient_id--audio-upload"></code></pre>
</span>
<form id="form-POSTpatient-document--patient_id--audio-upload" data-method="POST"
      data-path="patient-document/{patient_id}/audio/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-document--patient_id--audio-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-document--patient_id--audio-upload"
                    onclick="tryItOut('POSTpatient-document--patient_id--audio-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-document--patient_id--audio-upload"
                    onclick="cancelTryOut('POSTpatient-document--patient_id--audio-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-document--patient_id--audio-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-document/{patient_id}/audio/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-document--patient_id--audio-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-document--patient_id--audio-upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-document--patient_id--audio-upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-document--patient_id--audio-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-document--patient_id--audio-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-document--patient_id--audio-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-document--patient_id--audio-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpatient-document--patient_id--other-upload">[Patient Document Other] - Upload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatient-document--patient_id--other-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patient-document/1/other/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"document_name\": \"\",
    \"specialist_id\": 0,
    \"appointment_id\": 0,
    \"file\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patient-document/1/other/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_name": "",
    "specialist_id": 0,
    "appointment_id": 0,
    "file": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatient-document--patient_id--other-upload">
</span>
<span id="execution-results-POSTpatient-document--patient_id--other-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatient-document--patient_id--other-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatient-document--patient_id--other-upload"></code></pre>
</span>
<span id="execution-error-POSTpatient-document--patient_id--other-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatient-document--patient_id--other-upload"></code></pre>
</span>
<form id="form-POSTpatient-document--patient_id--other-upload" data-method="POST"
      data-path="patient-document/{patient_id}/other/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatient-document--patient_id--other-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatient-document--patient_id--other-upload"
                    onclick="tryItOut('POSTpatient-document--patient_id--other-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatient-document--patient_id--other-upload"
                    onclick="cancelTryOut('POSTpatient-document--patient_id--other-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatient-document--patient_id--other-upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patient-document/{patient_id}/other/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpatient-document--patient_id--other-upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatient-document--patient_id--other-upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="POSTpatient-document--patient_id--other-upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>document_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="document_name"
               data-endpoint="POSTpatient-document--patient_id--other-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="POSTpatient-document--patient_id--other-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpatient-document--patient_id--other-upload"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="file"
               data-endpoint="POSTpatient-document--patient_id--other-upload"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-POSTpre-admission--appointment_id--upload">[Pre Admission] - Upload Pre Admission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpre-admission--appointment_id--upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/pre-admission/1/upload" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pre-admission/1/upload"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpre-admission--appointment_id--upload">
</span>
<span id="execution-results-POSTpre-admission--appointment_id--upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpre-admission--appointment_id--upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpre-admission--appointment_id--upload"></code></pre>
</span>
<span id="execution-error-POSTpre-admission--appointment_id--upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpre-admission--appointment_id--upload"></code></pre>
</span>
<form id="form-POSTpre-admission--appointment_id--upload" data-method="POST"
      data-path="pre-admission/{appointment_id}/upload"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpre-admission--appointment_id--upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpre-admission--appointment_id--upload"
                    onclick="tryItOut('POSTpre-admission--appointment_id--upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpre-admission--appointment_id--upload"
                    onclick="cancelTryOut('POSTpre-admission--appointment_id--upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpre-admission--appointment_id--upload" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>pre-admission/{appointment_id}/upload</code></b>
        </p>
                <p>
            <label id="auth-POSTpre-admission--appointment_id--upload" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpre-admission--appointment_id--upload"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="POSTpre-admission--appointment_id--upload"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETpatients">[Patient] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpatients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients"></code></pre>
</span>
<span id="execution-error-GETpatients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients"></code></pre>
</span>
<form id="form-GETpatients" data-method="GET"
      data-path="patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients"
                    onclick="tryItOut('GETpatients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients"
                    onclick="cancelTryOut('GETpatients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients</code></b>
        </p>
                <p>
            <label id="auth-GETpatients" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatients"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETpatients--id-">[Patient] - Show</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients--id-"></code></pre>
</span>
<span id="execution-error-GETpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients--id-"></code></pre>
</span>
<form id="form-GETpatients--id-" data-method="GET"
      data-path="patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients--id-"
                    onclick="tryItOut('GETpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients--id-"
                    onclick="cancelTryOut('GETpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETpatients--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatients--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETpatients--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                    </form>

            <h2 id="endpoints-PUTpatients--id-">[Patient] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patients/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"\",
    \"last_name\": \"\",
    \"date_of_birth\": \"\",
    \"contact_number\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "",
    "last_name": "",
    "date_of_birth": "",
    "contact_number": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatients--id-">
</span>
<span id="execution-results-PUTpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatients--id-"></code></pre>
</span>
<span id="execution-error-PUTpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatients--id-"></code></pre>
</span>
<form id="form-PUTpatients--id-" data-method="PUT"
      data-path="patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatients--id-"
                    onclick="tryItOut('PUTpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatients--id-"
                    onclick="cancelTryOut('PUTpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatients--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patients/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patients/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatients--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatients--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatients--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="PUTpatients--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="PUTpatients--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>date_of_birth</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date_of_birth"
               data-endpoint="PUTpatients--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>contact_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="contact_number"
               data-endpoint="PUTpatients--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEpatients--id-">[Patient] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patients/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEpatients--id-">
</span>
<span id="execution-results-DELETEpatients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatients--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatients--id-"></code></pre>
</span>
<form id="form-DELETEpatients--id-" data-method="DELETE"
      data-path="patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatients--id-"
                    onclick="tryItOut('DELETEpatients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatients--id-"
                    onclick="cancelTryOut('DELETEpatients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatients--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patients/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatients--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatients--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatients--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETpatients-appointments--patient_id-">[Patient] - Appointment List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpatients-appointments--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/appointments/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/appointments/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpatients-appointments--patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients-appointments--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients-appointments--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients-appointments--patient_id-"></code></pre>
</span>
<span id="execution-error-GETpatients-appointments--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients-appointments--patient_id-"></code></pre>
</span>
<form id="form-GETpatients-appointments--patient_id-" data-method="GET"
      data-path="patients/appointments/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients-appointments--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients-appointments--patient_id-"
                    onclick="tryItOut('GETpatients-appointments--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients-appointments--patient_id-"
                    onclick="cancelTryOut('GETpatients-appointments--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients-appointments--patient_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/appointments/{patient_id}</code></b>
        </p>
                <p>
            <label id="auth-GETpatients-appointments--patient_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatients-appointments--patient_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="GETpatients-appointments--patient_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETletter-templates">[Letter Template] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETletter-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/letter-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/letter-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETletter-templates">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETletter-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETletter-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETletter-templates"></code></pre>
</span>
<span id="execution-error-GETletter-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETletter-templates"></code></pre>
</span>
<form id="form-GETletter-templates" data-method="GET"
      data-path="letter-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETletter-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETletter-templates"
                    onclick="tryItOut('GETletter-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETletter-templates"
                    onclick="cancelTryOut('GETletter-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETletter-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>letter-templates</code></b>
        </p>
                <p>
            <label id="auth-GETletter-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETletter-templates"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTletter-templates">[Letter Template] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTletter-templates">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/letter-templates" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"heading\": \"\",
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/letter-templates"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "heading": "",
    "body": ""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTletter-templates">
</span>
<span id="execution-results-POSTletter-templates" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTletter-templates"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTletter-templates"></code></pre>
</span>
<span id="execution-error-POSTletter-templates" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTletter-templates"></code></pre>
</span>
<form id="form-POSTletter-templates" data-method="POST"
      data-path="letter-templates"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTletter-templates', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTletter-templates"
                    onclick="tryItOut('POSTletter-templates');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTletter-templates"
                    onclick="cancelTryOut('POSTletter-templates');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTletter-templates" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>letter-templates</code></b>
        </p>
                <p>
            <label id="auth-POSTletter-templates" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTletter-templates"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>heading</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="heading"
               data-endpoint="POSTletter-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="POSTletter-templates"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTletter-templates--id-">[Letter Template] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTletter-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/letter-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"heading\": \"\",
    \"body\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/letter-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "heading": "",
    "body": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTletter-templates--id-">
</span>
<span id="execution-results-PUTletter-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTletter-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTletter-templates--id-"></code></pre>
</span>
<span id="execution-error-PUTletter-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTletter-templates--id-"></code></pre>
</span>
<form id="form-PUTletter-templates--id-" data-method="PUT"
      data-path="letter-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTletter-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTletter-templates--id-"
                    onclick="tryItOut('PUTletter-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTletter-templates--id-"
                    onclick="cancelTryOut('PUTletter-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTletter-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>letter-templates/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>letter-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTletter-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTletter-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTletter-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the letter template.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>heading</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="heading"
               data-endpoint="PUTletter-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>body</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="body"
               data-endpoint="PUTletter-templates--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEletter-templates--id-">[Letter Template] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEletter-templates--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/letter-templates/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/letter-templates/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEletter-templates--id-">
</span>
<span id="execution-results-DELETEletter-templates--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEletter-templates--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEletter-templates--id-"></code></pre>
</span>
<span id="execution-error-DELETEletter-templates--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEletter-templates--id-"></code></pre>
</span>
<form id="form-DELETEletter-templates--id-" data-method="DELETE"
      data-path="letter-templates/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEletter-templates--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEletter-templates--id-"
                    onclick="tryItOut('DELETEletter-templates--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEletter-templates--id-"
                    onclick="cancelTryOut('DELETEletter-templates--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEletter-templates--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>letter-templates/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEletter-templates--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEletter-templates--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEletter-templates--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the letter template.</p>
            </p>
                    </form>

            <h2 id="endpoints-GETprocedure-approvals">[Appointment Procedure Approval] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETprocedure-approvals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/procedure-approvals" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/procedure-approvals"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETprocedure-approvals">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETprocedure-approvals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETprocedure-approvals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETprocedure-approvals"></code></pre>
</span>
<span id="execution-error-GETprocedure-approvals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETprocedure-approvals"></code></pre>
</span>
<form id="form-GETprocedure-approvals" data-method="GET"
      data-path="procedure-approvals"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETprocedure-approvals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETprocedure-approvals"
                    onclick="tryItOut('GETprocedure-approvals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETprocedure-approvals"
                    onclick="cancelTryOut('GETprocedure-approvals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETprocedure-approvals" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>procedure-approvals</code></b>
        </p>
                <p>
            <label id="auth-GETprocedure-approvals" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETprocedure-approvals"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-PUTappointment--appointment_id--procedure-approvals">[Appointment Procedure Approval] - Update Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointment--appointment_id--procedure-approvals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointment/1/procedure-approvals" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"procedure_approval_status\": \"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment/1/procedure-approvals"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "procedure_approval_status": ""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointment--appointment_id--procedure-approvals">
</span>
<span id="execution-results-PUTappointment--appointment_id--procedure-approvals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointment--appointment_id--procedure-approvals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointment--appointment_id--procedure-approvals"></code></pre>
</span>
<span id="execution-error-PUTappointment--appointment_id--procedure-approvals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointment--appointment_id--procedure-approvals"></code></pre>
</span>
<form id="form-PUTappointment--appointment_id--procedure-approvals" data-method="PUT"
      data-path="appointment/{appointment_id}/procedure-approvals"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointment--appointment_id--procedure-approvals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointment--appointment_id--procedure-approvals"
                    onclick="tryItOut('PUTappointment--appointment_id--procedure-approvals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointment--appointment_id--procedure-approvals"
                    onclick="cancelTryOut('PUTappointment--appointment_id--procedure-approvals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointment--appointment_id--procedure-approvals" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointment/{appointment_id}/procedure-approvals</code></b>
        </p>
                <p>
            <label id="auth-PUTappointment--appointment_id--procedure-approvals" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointment--appointment_id--procedure-approvals"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointment--appointment_id--procedure-approvals"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>procedure_approval_status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="procedure_approval_status"
               data-endpoint="PUTappointment--appointment_id--procedure-approvals"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be one of <code>NOT_APPROVED</code>, <code>APPROVED</code>, or <code>CONSULT_REQUIRED</code>.</p>
        </p>
        </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
