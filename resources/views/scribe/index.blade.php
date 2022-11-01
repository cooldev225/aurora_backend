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
                <li class="tocify-item level-1" data-unique="appointments">
                    <a href="#appointments">Appointments</a>
                </li>
                                    <ul id="tocify-subheader-appointments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="appointments-PUTappointments-referral--appointment_id-">
                        <a href="#appointments-PUTappointments-referral--appointment_id-">[Referral] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="appointments-PUTappointments-update_collecting_person--appointment_id-">
                        <a href="#appointments-PUTappointments-update_collecting_person--appointment_id-">[Collecting Person] - Update</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
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
                    <ul id="tocify-header-4" class="tocify-header">
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
                                    <li class="tocify-item level-2" data-unique="endpoints-GETdoctor-address-books">
                        <a href="#endpoints-GETdoctor-address-books">[Doctor Address Book] - All</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTdoctor-address-books">
                        <a href="#endpoints-POSTdoctor-address-books">[Doctor Address Book] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTdoctor-address-books--id-">
                        <a href="#endpoints-PUTdoctor-address-books--id-">[Doctor Address Book] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEdoctor-address-books--id-">
                        <a href="#endpoints-DELETEdoctor-address-books--id-">[Doctor Address Book] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETuser-appointments">
                        <a href="#endpoints-GETuser-appointments">[User Appointment] - List</a>
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
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-wait-listed--appointment-">
                        <a href="#endpoints-PUTappointments-wait-listed--appointment-">Appointment wait listed</a>
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
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer">
                        <a href="#endpoints-GETlog-viewer">Show the dashboard.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer-logs">
                        <a href="#endpoints-GETlog-viewer-logs">List all logs.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETElog-viewer-logs-delete">
                        <a href="#endpoints-DELETElog-viewer-logs-delete">Delete a log.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer-logs--date-">
                        <a href="#endpoints-GETlog-viewer-logs--date-">Show the log.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer-logs--date--download">
                        <a href="#endpoints-GETlog-viewer-logs--date--download">Download the log</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer-logs--date---level-">
                        <a href="#endpoints-GETlog-viewer-logs--date---level-">Filter the log entries by level.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETlog-viewer-logs--date---level--search">
                        <a href="#endpoints-GETlog-viewer-logs--date---level--search">Show the log with the search query.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETadmin-log-reader">
                        <a href="#endpoints-GETadmin-log-reader">GET admin/log-reader</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTadmin-log-reader">
                        <a href="#endpoints-POSTadmin-log-reader">POST admin/log-reader</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETadmin-api-log-reader">
                        <a href="#endpoints-GETadmin-api-log-reader">GET admin/api/log-reader</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETmails---">
                        <a href="#endpoints-GETmails---">[Mail] - Show</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-DELETEmails---">
                        <a href="#endpoints-DELETEmails---">[Mail] - Destroy</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointments---">
                        <a href="#endpoints-GETappointments---">GET appointments/{}</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments---">
                        <a href="#endpoints-PUTappointments---">Update the specified resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GETappointments-confirmation-status">
                        <a href="#endpoints-GETappointments-confirmation-status">Display a listing of all appointments per their confirmation_status.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-PUTappointments-confirmation-status--appointment_id-">
                        <a href="#endpoints-PUTappointments-confirmation-status--appointment_id-">Updated the Appointment &#039;confirmation_status&#039; along with the reason for the status</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-5" class="tocify-header">
                <li class="tocify-item level-1" data-unique="patients">
                    <a href="#patients">Patients</a>
                </li>
                                    <ul id="tocify-subheader-patients" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="patients-GETpatients">
                        <a href="#patients-GETpatients">[Patient] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-GETpatients---">
                        <a href="#patients-GETpatients---">[Patient] - Show</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-PUTpatients---">
                        <a href="#patients-PUTpatients---">[Patient] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-GETpatients-recalls--patient_id-">
                        <a href="#patients-GETpatients-recalls--patient_id-">[Recall - List]</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-POSTpatients-recalls">
                        <a href="#patients-POSTpatients-recalls">[Recall] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-PUTpatients-recalls--id-">
                        <a href="#patients-PUTpatients-recalls--id-">[Recall] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="patients-DELETEpatients-recalls--id-">
                        <a href="#patients-DELETEpatients-recalls--id-">[Recall] - Destroy</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-6" class="tocify-header">
                <li class="tocify-item level-1" data-unique="settings">
                    <a href="#settings">Settings</a>
                </li>
                                    <ul id="tocify-subheader-settings" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="settings-GETanesthetic-questions">
                        <a href="#settings-GETanesthetic-questions">[Anesthetic Question] - List</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="settings-POSTanesthetic-questions">
                        <a href="#settings-POSTanesthetic-questions">[Anesthetic Question] - Store</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="settings-PUTanesthetic-questions--id-">
                        <a href="#settings-PUTanesthetic-questions--id-">[Anesthetic Question] - Update</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="settings-DELETEanesthetic-questions--id-">
                        <a href="#settings-DELETEanesthetic-questions--id-">[Anesthetic Question] - Destroy</a>
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
        <li>Last updated: August 25 2022</li>
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
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="appointments">Appointments</h1>

    

            <h2 id="appointments-PUTappointments-referral--appointment_id-">[Referral] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-referral--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/referral/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "doctor_address_books_id=2" \
    --form "referral_date=1993-23-03" \
    --form "referral_duration=3" \
    --form "file=@C:\Users\user\AppData\Local\Temp\php3078.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/referral/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('doctor_address_book_id', '2');
body.append('referral_date', '1993-23-03');
body.append('referral_duration', '3');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-referral--appointment_id-">
</span>
<span id="execution-results-PUTappointments-referral--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-referral--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-referral--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-referral--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-referral--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-referral--appointment_id-" data-method="PUT"
      data-path="appointments/referral/{appointment_id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-referral--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-referral--appointment_id-"
                    onclick="tryItOut('PUTappointments-referral--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-referral--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-referral--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-referral--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/referral/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-referral--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-referral--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-referral--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>doctor_address_book_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="doctor_address_book_id"
               data-endpoint="PUTappointments-referral--appointment_id-"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the doctor address book</p>
        </p>
                <p>
            <b><code>referral_date</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
                <input type="text"
               name="referral_date"
               data-endpoint="PUTappointments-referral--appointment_id-"
               value="1993-23-03"
               data-component="body" hidden>
    <br>
<p>The date the referral was issued</p>
        </p>
                <p>
            <b><code>referral_duration</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="referral_duration"
               data-endpoint="PUTappointments-referral--appointment_id-"
               value="3"
               data-component="body" hidden>
    <br>
<p>The duration the referral is valid</p>
        </p>
                <p>
            <b><code>file</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
                <input type="file"
               name="file"
               data-endpoint="PUTappointments-referral--appointment_id-"
               value=""
               data-component="body" hidden>
    <br>
<p>The referral file                    Example:</p>
        </p>
        </form>

            <h2 id="appointments-PUTappointments-update_collecting_person--appointment_id-">[Collecting Person] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-update_collecting_person--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/update_collecting_person/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"collecting_person_name\": \"Jessica Jack\",
    \"collecting_person_phone\": \"04-5112-5521\",
    \"collecting_person_alternate_contact\": \"03-2346-2344\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/update_collecting_person/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "collecting_person_name": "Jessica Jack",
    "collecting_person_phone": "04-5112-5521",
    "collecting_person_alternate_contact": "03-2346-2344"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-update_collecting_person--appointment_id-">
</span>
<span id="execution-results-PUTappointments-update_collecting_person--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-update_collecting_person--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-update_collecting_person--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-update_collecting_person--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-update_collecting_person--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-update_collecting_person--appointment_id-" data-method="PUT"
      data-path="appointments/update_collecting_person/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-update_collecting_person--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-update_collecting_person--appointment_id-"
                    onclick="tryItOut('PUTappointments-update_collecting_person--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-update_collecting_person--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-update_collecting_person--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-update_collecting_person--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/update_collecting_person/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-update_collecting_person--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-update_collecting_person--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-update_collecting_person--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>collecting_person_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="collecting_person_name"
               data-endpoint="PUTappointments-update_collecting_person--appointment_id-"
               value="Jessica Jack"
               data-component="body" hidden>
    <br>
<p>The name of the collecting person</p>
        </p>
                <p>
            <b><code>collecting_person_phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="collecting_person_phone"
               data-endpoint="PUTappointments-update_collecting_person--appointment_id-"
               value="04-5112-5521"
               data-component="body" hidden>
    <br>
<p>The phone number of the collecting person</p>
        </p>
                <p>
            <b><code>collecting_person_alternate_contact</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="collecting_person_alternate_contact"
               data-endpoint="PUTappointments-update_collecting_person--appointment_id-"
               value="03-2346-2344"
               data-component="body" hidden>
    <br>
<p>The alternate number of the collecting person</p>
        </p>
        </form>

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
    \"email\": \"reception@franksonpracktice.com.au\",
    \"phone_number\": \"04-3456-2342\",
    \"address\": \"natus\",
    \"hospital_provider_number\": \"31452352F\",
    \"VAED_number\": \"234234\",
    \"specimen_collection_point_number\": \"234234\",
    \"lspn_id\": \"234234\"
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
    "email": "reception@franksonpracktice.com.au",
    "phone_number": "04-3456-2342",
    "address": "natus",
    "hospital_provider_number": "31452352F",
    "VAED_number": "234234",
    "specimen_collection_point_number": "234234",
    "lspn_id": "234234"
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
               value="reception@franksonpracktice.com.au"
               data-component="body" hidden>
    <br>
<p>The Email of the clinic.</p>
        </p>
                <p>
            <b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone_number"
               data-endpoint="POSTclinics"
               value="04-3456-2342"
               data-component="body" hidden>
    <br>
<p>The Phone number of the clinic.</p>
        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="POSTclinics"
               value="natus"
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
               value="31452352F"
               data-component="body" hidden>
    <br>
<p>The provider number of the clinic.</p>
        </p>
                <p>
            <b><code>VAED_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="VAED_number"
               data-endpoint="POSTclinics"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The VAED number of the clinic.</p>
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
                <p>
            <b><code>specimen_collection_point_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="specimen_collection_point_number"
               data-endpoint="POSTclinics"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The specimen collection point number of the clinic.</p>
        </p>
                <p>
            <b><code>lspn_id</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lspn_id"
               data-endpoint="POSTclinics"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The LSPN id of the clinic.</p>
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
    \"email\": \"reception@franksonpracktice.com.au\",
    \"phone_number\": \"04-3456-2342\",
    \"address\": \"consectetur\",
    \"hospital_provider_number\": \"31452352F\",
    \"VAED_number\": \"234234\",
    \"specimen_collection_point_number\": \"234234\",
    \"lspn_id\": \"234234\"
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
    "email": "reception@franksonpracktice.com.au",
    "phone_number": "04-3456-2342",
    "address": "consectetur",
    "hospital_provider_number": "31452352F",
    "VAED_number": "234234",
    "specimen_collection_point_number": "234234",
    "lspn_id": "234234"
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
               value="reception@franksonpracktice.com.au"
               data-component="body" hidden>
    <br>
<p>The Email of the clinic.</p>
        </p>
                <p>
            <b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone_number"
               data-endpoint="PUTclinics--id-"
               value="04-3456-2342"
               data-component="body" hidden>
    <br>
<p>The Phone number of the clinic.</p>
        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="PUTclinics--id-"
               value="consectetur"
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
               value="31452352F"
               data-component="body" hidden>
    <br>
<p>The provider number of the clinic.</p>
        </p>
                <p>
            <b><code>VAED_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="VAED_number"
               data-endpoint="PUTclinics--id-"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The VAED number of the clinic.</p>
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
                <p>
            <b><code>specimen_collection_point_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="specimen_collection_point_number"
               data-endpoint="PUTclinics--id-"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The specimen collection point number of the clinic.</p>
        </p>
                <p>
            <b><code>lspn_id</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lspn_id"
               data-endpoint="PUTclinics--id-"
               value="234234"
               data-component="body" hidden>
    <br>
<p>The LSPN id of the clinic.</p>
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
        &quot;name&quot;: &quot;Frankston Practice&quot;,
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
    \"username\": \"uik\",
    \"email\": \"samson33@example.org\",
    \"password\": \"uq\"
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
    "username": "uik",
    "email": "samson33@example.org",
    "password": "uq"
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
               value="uik"
               data-component="body" hidden>
    <br>
<p>Must be at least 2 characters. Must not be greater than 100 characters.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTlogin"
               value="samson33@example.org"
               data-component="body" hidden>
    <br>
<p>Must be a valid email address.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTlogin"
               value="uq"
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
    \"old_password\": \"dcks\",
    \"new_password\": \"aoreua\",
    \"confirm_password\": \"bnybm\"
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
    "old_password": "dcks",
    "new_password": "aoreua",
    "confirm_password": "bnybm"
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
               value="dcks"
               data-component="body" hidden>
    <br>
<p>Must be at least 6 characters.</p>
        </p>
                <p>
            <b><code>new_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="new_password"
               data-endpoint="POSTchange-password"
               value="aoreua"
               data-component="body" hidden>
    <br>
<p>The value and <code>old_password</code> must be different. Must be at least 6 characters.</p>
        </p>
                <p>
            <b><code>confirm_password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="confirm_password"
               data-endpoint="POSTchange-password"
               value="bnybm"
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
    --get "http://localhost/appointment_pre_admissions/show/iure" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/show/iure"
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
               value="iure"
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
    "http://localhost/appointment_pre_admissions/validate/officiis" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/validate/officiis"
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
               value="officiis"
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
    "http://localhost/appointment_pre_admissions/store/expedita" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointment_pre_admissions/store/expedita"
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
               value="expedita"
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
    "http://localhost/mails/bookmark/temporibus" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/bookmark/temporibus"
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
               value="temporibus"
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
    "http://localhost/mails/delete/omnis" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/delete/omnis"
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
               value="omnis"
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
    "http://localhost/mails/restore/et" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/restore/et"
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
               value="et"
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
    "http://localhost/admins/et" \
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
    "http://localhost/admins/et"
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
               value="et"
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
    "http://localhost/admins/id" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admins/id"
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
               value="id"
               data-component="url" hidden>
    <br>
<p>The ID of the admin.</p>
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
    "http://localhost/birth-codes/14" \
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
    "http://localhost/birth-codes/14"
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
               value="14"
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
    "http://localhost/birth-codes/13" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/birth-codes/13"
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
               value="13"
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
    "http://localhost/organization-admins/dolor" \
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
    "http://localhost/organization-admins/dolor"
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
               value="dolor"
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
    "http://localhost/organization-admins/omnis" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-admins/omnis"
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
               value="omnis"
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
    "http://localhost/organization-managers/eos" \
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
    "http://localhost/organization-managers/eos"
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
               value="eos"
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
    "http://localhost/organization-managers/sit" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/organization-managers/sit"
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
               value="sit"
               data-component="url" hidden>
    <br>
<p>The ID of the organization manager.</p>
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

            <h2 id="endpoints-GETdoctor-address-books">[Doctor Address Book] - All</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETdoctor-address-books">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/doctor-address-books" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/doctor-address-books"
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

<span id="example-responses-GETdoctor-address-books">
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
<span id="execution-results-GETdoctor-address-books" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETdoctor-address-books"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETdoctor-address-books"></code></pre>
</span>
<span id="execution-error-GETdoctor-address-books" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETdoctor-address-books"></code></pre>
</span>
<form id="form-GETdoctor-address-books" data-method="GET"
      data-path="doctor-address-books"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETdoctor-address-books', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETdoctor-address-books"
                    onclick="tryItOut('GETdoctor-address-books');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETdoctor-address-books"
                    onclick="cancelTryOut('GETdoctor-address-books');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETdoctor-address-books" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>doctor-address-books</code></b>
        </p>
                <p>
            <label id="auth-GETdoctor-address-books" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETdoctor-address-books"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTdoctor-address-books">[Doctor Address Book] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTdoctor-address-books">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/doctor-address-books" \
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
    "http://localhost/doctor-address-books"
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

<span id="example-responses-POSTdoctor-address-books">
</span>
<span id="execution-results-POSTdoctor-address-books" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTdoctor-address-books"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTdoctor-address-books"></code></pre>
</span>
<span id="execution-error-POSTdoctor-address-books" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTdoctor-address-books"></code></pre>
</span>
<form id="form-POSTdoctor-address-books" data-method="POST"
      data-path="doctor-address-books"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTdoctor-address-books', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTdoctor-address-books"
                    onclick="tryItOut('POSTdoctor-address-books');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTdoctor-address-books"
                    onclick="cancelTryOut('POSTdoctor-address-books');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTdoctor-address-books" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>doctor-address-books</code></b>
        </p>
                <p>
            <label id="auth-POSTdoctor-address-books" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTdoctor-address-books"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>provider_no</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="provider_no"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>street</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="street"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>city</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="city"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="state"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>country</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="country"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>postcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="postcode"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="fax"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>mobile</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="mobile"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>practice_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="practice_name"
               data-endpoint="POSTdoctor-address-books"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-PUTdoctor-address-books--id-">[doctor-address-book] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTdoctor-address-books--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/doctor-address-books/1" \
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
    "http://localhost/doctor-address-books/1"
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

<span id="example-responses-PUTdoctor-address-books--id-">
</span>
<span id="execution-results-PUTdoctor-address-books--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTdoctor-address-books--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTdoctor-address-books--id-"></code></pre>
</span>
<span id="execution-error-PUTdoctor-address-books--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTdoctor-address-books--id-"></code></pre>
</span>
<form id="form-PUTdoctor-address-books--id-" data-method="PUT"
      data-path="doctor-address-books/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTdoctor-address-books--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTdoctor-address-books--id-"
                    onclick="tryItOut('PUTdoctor-address-books--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTdoctor-address-books--id-"
                    onclick="cancelTryOut('PUTdoctor-address-books--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTdoctor-address-books--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>doctor-address-books/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>doctor-address-books/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTdoctor-address-books--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTdoctor-address-books--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTdoctor-address-books--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the doctor address book.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>provider_no</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="provider_no"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="address"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>street</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="street"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>city</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="city"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="state"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>country</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="country"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>postcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="postcode"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="phone"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>fax</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="fax"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>mobile</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="mobile"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>practice_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="practice_name"
               data-endpoint="PUTdoctor-address-books--id-"
               value=""
               data-component="body" hidden>
    <br>

        </p>
        </form>

            <h2 id="endpoints-DELETEdoctor-address-books--id-">[Doctor Address Book] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEdoctor-address-books--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/doctor-address-books/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/doctor-address-books/1"
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

<span id="example-responses-DELETEdoctor-address-books--id-">
</span>
<span id="execution-results-DELETEdoctor-address-books--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEdoctor-address-books--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEdoctor-address-books--id-"></code></pre>
</span>
<span id="execution-error-DELETEdoctor-address-books--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEdoctor-address-books--id-"></code></pre>
</span>
<form id="form-DELETEdoctor-address-books--id-" data-method="DELETE"
      data-path="doctor-address-books/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEdoctor-address-books--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEdoctor-address-books--id-"
                    onclick="tryItOut('DELETEdoctor-address-books--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEdoctor-address-books--id-"
                    onclick="cancelTryOut('DELETEdoctor-address-books--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEdoctor-address-books--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>doctor-address-books/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEdoctor-address-books--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEdoctor-address-books--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEdoctor-address-books--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the doctor address book.</p>
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

            <h2 id="endpoints-PUTappointments-wait-listed--appointment-">Appointment wait listed</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-wait-listed--appointment-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/wait-listed/inventore" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/wait-listed/inventore"
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
               value="inventore"
               data-component="url" hidden>
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
    \"appointment_id\": 13,
    \"description\": \"ut\",
    \"diagnosis\": \"ratione\",
    \"clinical_assessment\": \"aliquid\",
    \"treatment\": \"esse\",
    \"history\": \"nobis\",
    \"additional_details\": \"veniam\"
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
    "appointment_id": 13,
    "description": "ut",
    "diagnosis": "ratione",
    "clinical_assessment": "aliquid",
    "treatment": "esse",
    "history": "nobis",
    "additional_details": "veniam"
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
               value="13"
               data-component="body" hidden>
    <br>
<p>Appointment ID.</p>
        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="ut"
               data-component="body" hidden>
    <br>
<p>Description.</p>
        </p>
                <p>
            <b><code>diagnosis</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="diagnosis"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="ratione"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>clinical_assessment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="clinical_assessment"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="aliquid"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>treatment</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="treatment"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="esse"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>history</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="history"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="nobis"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>additional_details</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="additional_details"
               data-endpoint="PUTpatient-documents-clinical-note--id-"
               value="veniam"
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

            <h2 id="endpoints-GETlog-viewer">Show the dashboard.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer"
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

<span id="example-responses-GETlog-viewer">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=UTF-8
cache-control: no-cache, private
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!doctype html&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1, shrink-to-fit=no&quot;&gt;
    &lt;meta name=&quot;description&quot; content=&quot;LogViewer&quot;&gt;
    &lt;meta name=&quot;author&quot; content=&quot;ARCANEDEV&quot;&gt;
    &lt;title&gt;LogViewer - Created by ARCANEDEV&lt;/title&gt;
    
    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css&quot; integrity=&quot;sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm&quot; crossorigin=&quot;anonymous&quot;&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css&quot;&gt;
    &lt;link href=&#039;https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600&#039; rel=&#039;stylesheet&#039; type=&#039;text/css&#039;&gt;
    &lt;style&gt;
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: .875rem;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: .25rem;
        }

        .box &gt; .box-icon &gt; i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box &gt; .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px; width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0,0,0,0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0,0,0,0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge &amp; Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: #8A8A8A;
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: #B71C1C;
        }

        .badge.badge-level-alert,
        .box.level-alert  {
            background-color: #D32F2F;
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: #F44336;
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: #FF5722;
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: #FF9100;
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: #4CAF50;
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: #1976D2;
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: #90CAF9;
        }

        .badge.empty,
        .box.empty {
            background-color: #D1D1D1;
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
        
        #entries {
            overflow-wrap: anywhere;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;nav class=&quot;navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0&quot;&gt;
        &lt;a href=&quot;http://localhost/log-viewer&quot; class=&quot;navbar-brand mr-0&quot;&gt;
            &lt;i class=&quot;fa fa-fw fa-book&quot;&gt;&lt;/i&gt; LogViewer
        &lt;/a&gt;
        &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarNav&quot; aria-controls=&quot;navbarNav&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
            &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
        &lt;/button&gt;
        &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarNav&quot;&gt;
            &lt;ul class=&quot;navbar-nav mr-auto&quot;&gt;
                &lt;li class=&quot;nav-item active&quot;&gt;
                    &lt;a href=&quot;http://localhost/log-viewer&quot; class=&quot;nav-link&quot;&gt;
                        &lt;i class=&quot;fa fa-dashboard&quot;&gt;&lt;/i&gt; Dashboard                    &lt;/a&gt;
                &lt;/li&gt;
                &lt;li class=&quot;nav-item &quot;&gt;
                    &lt;a href=&quot;http://localhost/log-viewer/logs&quot; class=&quot;nav-link&quot;&gt;
                        &lt;i class=&quot;fa fa-archive&quot;&gt;&lt;/i&gt; Logs                    &lt;/a&gt;
                &lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/nav&gt;

    &lt;div class=&quot;container-fluid&quot;&gt;
        &lt;main role=&quot;main&quot; class=&quot;pt-3&quot;&gt;
                &lt;div class=&quot;page-header mb-4&quot;&gt;
        &lt;h1&gt;Dashboard&lt;/h1&gt;
    &lt;/div&gt;

    &lt;div class=&quot;row&quot;&gt;
        &lt;div class=&quot;col-md-6 col-lg-3&quot;&gt;
            &lt;canvas id=&quot;stats-doughnut-chart&quot; height=&quot;300&quot; class=&quot;mb-3&quot;&gt;&lt;/canvas&gt;
        &lt;/div&gt;

        &lt;div class=&quot;col-md-6 col-lg-9&quot;&gt;
            &lt;div class=&quot;row&quot;&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-all &quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-list&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;All&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    21 entries - 100 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 100%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-emergency empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-bug&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Emergency&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-alert empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-bullhorn&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Alert&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-critical empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-heartbeat&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Critical&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-error &quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-times-circle&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Error&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    21 entries - 100 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 100%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-warning empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-exclamation-triangle&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Warning&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-notice empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-exclamation-circle&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Notice&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-info empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-info-circle&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Info&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                                    &lt;div class=&quot;col-sm-6 col-md-12 col-lg-4 mb-3&quot;&gt;
                        &lt;div class=&quot;box level-debug empty&quot;&gt;
                            &lt;div class=&quot;box-icon&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-life-ring&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;box-content&quot;&gt;
                                &lt;span class=&quot;box-text&quot;&gt;Debug&lt;/span&gt;
                                &lt;span class=&quot;box-number&quot;&gt;
                                    0 entries - 0 %
                                &lt;/span&gt;
                                &lt;div class=&quot;progress&quot; style=&quot;height: 3px;&quot;&gt;
                                    &lt;div class=&quot;progress-bar&quot; style=&quot;width: 0%&quot;&gt;&lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
        &lt;/main&gt;
    &lt;/div&gt;

    
    &lt;footer class=&quot;main-footer&quot;&gt;
        &lt;div class=&quot;container-fluid&quot;&gt;
            &lt;p class=&quot;text-muted pull-left&quot;&gt;
                LogViewer - &lt;span class=&quot;badge badge-info&quot;&gt;version 9.0.0&lt;/span&gt;
            &lt;/p&gt;
            &lt;p class=&quot;text-muted pull-right&quot;&gt;
                Created with &lt;i class=&quot;fa fa-heart&quot;&gt;&lt;/i&gt; by ARCANEDEV &lt;sup&gt;&amp;copy;&lt;/sup&gt;
            &lt;/p&gt;
        &lt;/div&gt;
    &lt;/footer&gt;

    
    &lt;script src=&quot;https://code.jquery.com/jquery-3.2.1.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js&quot;&gt;&lt;/script&gt;

            &lt;script&gt;
        $(function() {
            new Chart(document.getElementById(&quot;stats-doughnut-chart&quot;), {
                type: &#039;doughnut&#039;,
                data: {&quot;labels&quot;:[&quot;Emergency&quot;,&quot;Alert&quot;,&quot;Critical&quot;,&quot;Error&quot;,&quot;Warning&quot;,&quot;Notice&quot;,&quot;Info&quot;,&quot;Debug&quot;],&quot;datasets&quot;:[{&quot;data&quot;:[0,0,0,21,0,0,0,0],&quot;backgroundColor&quot;:[&quot;#B71C1C&quot;,&quot;#D32F2F&quot;,&quot;#F44336&quot;,&quot;#FF5722&quot;,&quot;#FF9100&quot;,&quot;#4CAF50&quot;,&quot;#1976D2&quot;,&quot;#90CAF9&quot;],&quot;hoverBackgroundColor&quot;:[&quot;#B71C1C&quot;,&quot;#D32F2F&quot;,&quot;#F44336&quot;,&quot;#FF5722&quot;,&quot;#FF9100&quot;,&quot;#4CAF50&quot;,&quot;#1976D2&quot;,&quot;#90CAF9&quot;]}]},
                options: {
                    legend: {
                        position: &#039;bottom&#039;
                    }
                }
            });
        });
    &lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer"></code></pre>
</span>
<span id="execution-error-GETlog-viewer" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer"></code></pre>
</span>
<form id="form-GETlog-viewer" data-method="GET"
      data-path="log-viewer"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer"
                    onclick="tryItOut('GETlog-viewer');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer"
                    onclick="cancelTryOut('GETlog-viewer');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETlog-viewer-logs">List all logs.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer-logs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer/logs" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs"
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

<span id="example-responses-GETlog-viewer-logs">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=UTF-8
cache-control: no-cache, private
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!doctype html&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1, shrink-to-fit=no&quot;&gt;
    &lt;meta name=&quot;description&quot; content=&quot;LogViewer&quot;&gt;
    &lt;meta name=&quot;author&quot; content=&quot;ARCANEDEV&quot;&gt;
    &lt;title&gt;LogViewer - Created by ARCANEDEV&lt;/title&gt;
    
    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css&quot; integrity=&quot;sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm&quot; crossorigin=&quot;anonymous&quot;&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css&quot;&gt;
    &lt;link href=&#039;https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600&#039; rel=&#039;stylesheet&#039; type=&#039;text/css&#039;&gt;
    &lt;style&gt;
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: .875rem;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: .25rem;
        }

        .box &gt; .box-icon &gt; i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box &gt; .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px; width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0,0,0,0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0,0,0,0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge &amp; Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: #8A8A8A;
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: #B71C1C;
        }

        .badge.badge-level-alert,
        .box.level-alert  {
            background-color: #D32F2F;
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: #F44336;
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: #FF5722;
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: #FF9100;
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: #4CAF50;
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: #1976D2;
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: #90CAF9;
        }

        .badge.empty,
        .box.empty {
            background-color: #D1D1D1;
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
        
        #entries {
            overflow-wrap: anywhere;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;nav class=&quot;navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0&quot;&gt;
        &lt;a href=&quot;http://localhost/log-viewer&quot; class=&quot;navbar-brand mr-0&quot;&gt;
            &lt;i class=&quot;fa fa-fw fa-book&quot;&gt;&lt;/i&gt; LogViewer
        &lt;/a&gt;
        &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-toggle=&quot;collapse&quot; data-target=&quot;#navbarNav&quot; aria-controls=&quot;navbarNav&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
            &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
        &lt;/button&gt;
        &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarNav&quot;&gt;
            &lt;ul class=&quot;navbar-nav mr-auto&quot;&gt;
                &lt;li class=&quot;nav-item &quot;&gt;
                    &lt;a href=&quot;http://localhost/log-viewer&quot; class=&quot;nav-link&quot;&gt;
                        &lt;i class=&quot;fa fa-dashboard&quot;&gt;&lt;/i&gt; Dashboard                    &lt;/a&gt;
                &lt;/li&gt;
                &lt;li class=&quot;nav-item active&quot;&gt;
                    &lt;a href=&quot;http://localhost/log-viewer/logs&quot; class=&quot;nav-link&quot;&gt;
                        &lt;i class=&quot;fa fa-archive&quot;&gt;&lt;/i&gt; Logs                    &lt;/a&gt;
                &lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/nav&gt;

    &lt;div class=&quot;container-fluid&quot;&gt;
        &lt;main role=&quot;main&quot; class=&quot;pt-3&quot;&gt;
                &lt;div class=&quot;page-header mb-4&quot;&gt;
        &lt;h1&gt;Logs&lt;/h1&gt;
    &lt;/div&gt;

    &lt;div class=&quot;table-responsive&quot;&gt;
        &lt;table class=&quot;table table-sm table-hover&quot;&gt;
            &lt;thead&gt;
                &lt;tr&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-left&quot;&gt;
                                                    &lt;span class=&quot;badge badge-info&quot;&gt;Date&lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-all&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-list&quot;&gt;&lt;/i&gt; All
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-emergency&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-bug&quot;&gt;&lt;/i&gt; Emergency
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-alert&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-bullhorn&quot;&gt;&lt;/i&gt; Alert
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-critical&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-heartbeat&quot;&gt;&lt;/i&gt; Critical
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-error&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-times-circle&quot;&gt;&lt;/i&gt; Error
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-warning&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-exclamation-triangle&quot;&gt;&lt;/i&gt; Warning
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-notice&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-exclamation-circle&quot;&gt;&lt;/i&gt; Notice
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-info&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-info-circle&quot;&gt;&lt;/i&gt; Info
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-center&quot;&gt;
                                                    &lt;span class=&quot;badge badge-level-debug&quot;&gt;
                                &lt;i class=&quot;fa fa-fw fa-life-ring&quot;&gt;&lt;/i&gt; Debug
                            &lt;/span&gt;
                                            &lt;/th&gt;
                                        &lt;th scope=&quot;col&quot; class=&quot;text-right&quot;&gt;Actions&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
                                    &lt;tr&gt;
                                                    &lt;td class=&quot;text-left&quot;&gt;
                                                                    &lt;span class=&quot;badge badge-primary&quot;&gt;2022-08-25&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;a href=&quot;http://localhost/log-viewer/logs/2022-08-25/all&quot;&gt;
                                        &lt;span class=&quot;badge badge-level-all&quot;&gt;21&lt;/span&gt;
                                    &lt;/a&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;a href=&quot;http://localhost/log-viewer/logs/2022-08-25/error&quot;&gt;
                                        &lt;span class=&quot;badge badge-level-error&quot;&gt;21&lt;/span&gt;
                                    &lt;/a&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                    &lt;td class=&quot;text-center&quot;&gt;
                                                                    &lt;span class=&quot;badge empty&quot;&gt;0&lt;/span&gt;
                                                            &lt;/td&gt;
                                                &lt;td class=&quot;text-right&quot;&gt;
                            &lt;a href=&quot;http://localhost/log-viewer/logs/2022-08-25&quot; class=&quot;btn btn-sm btn-info&quot;&gt;
                                &lt;i class=&quot;fa fa-search&quot;&gt;&lt;/i&gt;
                            &lt;/a&gt;
                            &lt;a href=&quot;http://localhost/log-viewer/logs/2022-08-25/download&quot; class=&quot;btn btn-sm btn-success&quot;&gt;
                                &lt;i class=&quot;fa fa-download&quot;&gt;&lt;/i&gt;
                            &lt;/a&gt;
                            &lt;a href=&quot;#delete-log-modal&quot; class=&quot;btn btn-sm btn-danger&quot; data-log-date=&quot;2022-08-25&quot;&gt;
                                &lt;i class=&quot;fa fa-trash-o&quot;&gt;&lt;/i&gt;
                            &lt;/a&gt;
                        &lt;/td&gt;
                    &lt;/tr&gt;
                            &lt;/tbody&gt;
        &lt;/table&gt;
    &lt;/div&gt;

    
        &lt;/main&gt;
    &lt;/div&gt;

    
    &lt;footer class=&quot;main-footer&quot;&gt;
        &lt;div class=&quot;container-fluid&quot;&gt;
            &lt;p class=&quot;text-muted pull-left&quot;&gt;
                LogViewer - &lt;span class=&quot;badge badge-info&quot;&gt;version 9.0.0&lt;/span&gt;
            &lt;/p&gt;
            &lt;p class=&quot;text-muted pull-right&quot;&gt;
                Created with &lt;i class=&quot;fa fa-heart&quot;&gt;&lt;/i&gt; by ARCANEDEV &lt;sup&gt;&amp;copy;&lt;/sup&gt;
            &lt;/p&gt;
        &lt;/div&gt;
    &lt;/footer&gt;

    
    &lt;script src=&quot;https://code.jquery.com/jquery-3.2.1.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js&quot;&gt;&lt;/script&gt;

        
    &lt;div id=&quot;delete-log-modal&quot; class=&quot;modal fade&quot; tabindex=&quot;-1&quot; role=&quot;dialog&quot;&gt;
        &lt;div class=&quot;modal-dialog&quot; role=&quot;document&quot;&gt;
            &lt;form id=&quot;delete-log-form&quot; action=&quot;http://localhost/log-viewer/logs/delete&quot; method=&quot;POST&quot;&gt;
                &lt;input type=&quot;hidden&quot; name=&quot;_method&quot; value=&quot;DELETE&quot;&gt;
                &lt;input type=&quot;hidden&quot; name=&quot;_token&quot; value=&quot;&quot;&gt;
                &lt;input type=&quot;hidden&quot; name=&quot;date&quot; value=&quot;&quot;&gt;
                &lt;div class=&quot;modal-content&quot;&gt;
                    &lt;div class=&quot;modal-header&quot;&gt;
                        &lt;h5 class=&quot;modal-title&quot;&gt;Delete log file&lt;/h5&gt;
                        &lt;button type=&quot;button&quot; class=&quot;close&quot; data-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;
                            &lt;span aria-hidden=&quot;true&quot;&gt;&amp;times;&lt;/span&gt;
                        &lt;/button&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;modal-body&quot;&gt;
                        &lt;p&gt;&lt;/p&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;modal-footer&quot;&gt;
                        &lt;button type=&quot;button&quot; class=&quot;btn btn-sm btn-secondary mr-auto&quot; data-dismiss=&quot;modal&quot;&gt;Cancel&lt;/button&gt;
                        &lt;button type=&quot;submit&quot; class=&quot;btn btn-sm btn-danger&quot; data-loading-text=&quot;Loading&amp;hellip;&quot;&gt;Delete&lt;/button&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/form&gt;
        &lt;/div&gt;
    &lt;/div&gt;
        &lt;script&gt;
        $(function () {
            var deleteLogModal = $(&#039;div#delete-log-modal&#039;),
                deleteLogForm  = $(&#039;form#delete-log-form&#039;),
                submitBtn      = deleteLogForm.find(&#039;button[type=submit]&#039;);

            $(&quot;a[href=&#039;#delete-log-modal&#039;]&quot;).on(&#039;click&#039;, function(event) {
                event.preventDefault();
                var date    = $(this).data(&#039;log-date&#039;),
                    message = &quot;Are you sure you want to delete this log file: :date ?&quot;;

                deleteLogForm.find(&#039;input[name=date]&#039;).val(date);
                deleteLogModal.find(&#039;.modal-body p&#039;).html(message.replace(&#039;:date&#039;, date));

                deleteLogModal.modal(&#039;show&#039;);
            });

            deleteLogForm.on(&#039;submit&#039;, function(event) {
                event.preventDefault();
                submitBtn.button(&#039;loading&#039;);

                $.ajax({
                    url:      $(this).attr(&#039;action&#039;),
                    type:     $(this).attr(&#039;method&#039;),
                    dataType: &#039;json&#039;,
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button(&#039;reset&#039;);
                        if (data.result === &#039;success&#039;) {
                            deleteLogModal.modal(&#039;hide&#039;);
                            location.reload();
                        }
                        else {
                            alert(&#039;AJAX ERROR ! Check the console !&#039;);
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert(&#039;AJAX ERROR ! Check the console !&#039;);
                        console.error(errorThrown);
                        submitBtn.button(&#039;reset&#039;);
                    }
                });

                return false;
            });

            deleteLogModal.on(&#039;hidden.bs.modal&#039;, function() {
                deleteLogForm.find(&#039;input[name=date]&#039;).val(&#039;&#039;);
                deleteLogModal.find(&#039;.modal-body p&#039;).html(&#039;&#039;);
            });
        });
    &lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer-logs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer-logs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer-logs"></code></pre>
</span>
<span id="execution-error-GETlog-viewer-logs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer-logs"></code></pre>
</span>
<form id="form-GETlog-viewer-logs" data-method="GET"
      data-path="log-viewer/logs"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer-logs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer-logs"
                    onclick="tryItOut('GETlog-viewer-logs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer-logs"
                    onclick="cancelTryOut('GETlog-viewer-logs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer-logs" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer/logs</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer-logs" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer-logs"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-DELETElog-viewer-logs-delete">Delete a log.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETElog-viewer-logs-delete">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/log-viewer/logs/delete" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs/delete"
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

<span id="example-responses-DELETElog-viewer-logs-delete">
</span>
<span id="execution-results-DELETElog-viewer-logs-delete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETElog-viewer-logs-delete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETElog-viewer-logs-delete"></code></pre>
</span>
<span id="execution-error-DELETElog-viewer-logs-delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETElog-viewer-logs-delete"></code></pre>
</span>
<form id="form-DELETElog-viewer-logs-delete" data-method="DELETE"
      data-path="log-viewer/logs/delete"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETElog-viewer-logs-delete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETElog-viewer-logs-delete"
                    onclick="tryItOut('DELETElog-viewer-logs-delete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETElog-viewer-logs-delete"
                    onclick="cancelTryOut('DELETElog-viewer-logs-delete');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETElog-viewer-logs-delete" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>log-viewer/logs/delete</code></b>
        </p>
                <p>
            <label id="auth-DELETElog-viewer-logs-delete" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETElog-viewer-logs-delete"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETlog-viewer-logs--date-">Show the log.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer-logs--date-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer/logs/ipsam" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs/ipsam"
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

<span id="example-responses-GETlog-viewer-logs--date-">
            <blockquote>
            <p>Example response (404):</p>
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
    &quot;message&quot;: &quot;Log not found in this date [ipsam]&quot;,
    &quot;exception&quot;: &quot;Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException&quot;,
    &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php&quot;,
    &quot;line&quot;: 1145,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\helpers.php&quot;,
            &quot;line&quot;: 44,
            &quot;function&quot;: &quot;abort&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Http\\Controllers\\LogViewerController.php&quot;,
            &quot;line&quot;: 259,
            &quot;function&quot;: &quot;abort&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Http\\Controllers\\LogViewerController.php&quot;,
            &quot;line&quot;: 103,
            &quot;function&quot;: &quot;getLogOrFail&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php&quot;,
            &quot;line&quot;: 54,
            &quot;function&quot;: &quot;show&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;callAction&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Controller&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 261,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\ControllerDispatcher&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 204,
            &quot;function&quot;: &quot;runController&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 725,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Routing\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 726,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 703,
            &quot;function&quot;: &quot;runRouteWithinStack&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 667,
            &quot;function&quot;: &quot;runRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 656,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 167,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\HandleCors&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 142,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 111,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 287,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 89,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 222,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 123,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 80,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 56,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php&quot;,
            &quot;line&quot;: 55,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php&quot;,
            &quot;line&quot;: 651,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 139,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Command\\Command.php&quot;,
            &quot;line&quot;: 308,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 124,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 998,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 171,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php&quot;,
            &quot;line&quot;: 129,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer-logs--date-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer-logs--date-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer-logs--date-"></code></pre>
</span>
<span id="execution-error-GETlog-viewer-logs--date-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer-logs--date-"></code></pre>
</span>
<form id="form-GETlog-viewer-logs--date-" data-method="GET"
      data-path="log-viewer/logs/{date}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer-logs--date-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer-logs--date-"
                    onclick="tryItOut('GETlog-viewer-logs--date-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer-logs--date-"
                    onclick="cancelTryOut('GETlog-viewer-logs--date-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer-logs--date-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer/logs/{date}</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer-logs--date-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer-logs--date-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="GETlog-viewer-logs--date-"
               value="ipsam"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-GETlog-viewer-logs--date--download">Download the log</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer-logs--date--download">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer/logs/laborum/download" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs/laborum/download"
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

<span id="example-responses-GETlog-viewer-logs--date--download">
            <blockquote>
            <p>Example response (500):</p>
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
    &quot;message&quot;: &quot;The log(s) could not be located at : C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\storage\\logs\\laravel-laborum.log&quot;,
    &quot;exception&quot;: &quot;Arcanedev\\LogViewer\\Exceptions\\FilesystemException&quot;,
    &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Exceptions\\FilesystemException.php&quot;,
    &quot;line&quot;: 21,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Utilities\\Filesystem.php&quot;,
            &quot;line&quot;: 322,
            &quot;function&quot;: &quot;invalidPath&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Exceptions\\FilesystemException&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Utilities\\Filesystem.php&quot;,
            &quot;line&quot;: 284,
            &quot;function&quot;: &quot;getLogPath&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Utilities\\Filesystem&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\LogViewer.php&quot;,
            &quot;line&quot;: 220,
            &quot;function&quot;: &quot;path&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Utilities\\Filesystem&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Http\\Controllers\\LogViewerController.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;download&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\LogViewer&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php&quot;,
            &quot;line&quot;: 54,
            &quot;function&quot;: &quot;download&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;callAction&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Controller&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 261,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\ControllerDispatcher&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 204,
            &quot;function&quot;: &quot;runController&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 725,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Routing\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 726,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 703,
            &quot;function&quot;: &quot;runRouteWithinStack&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 667,
            &quot;function&quot;: &quot;runRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 656,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 167,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\HandleCors&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 142,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 111,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 287,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 89,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 222,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 123,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 80,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 56,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php&quot;,
            &quot;line&quot;: 55,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php&quot;,
            &quot;line&quot;: 651,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 139,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Command\\Command.php&quot;,
            &quot;line&quot;: 308,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 124,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 998,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 171,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php&quot;,
            &quot;line&quot;: 129,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer-logs--date--download" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer-logs--date--download"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer-logs--date--download"></code></pre>
</span>
<span id="execution-error-GETlog-viewer-logs--date--download" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer-logs--date--download"></code></pre>
</span>
<form id="form-GETlog-viewer-logs--date--download" data-method="GET"
      data-path="log-viewer/logs/{date}/download"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer-logs--date--download', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer-logs--date--download"
                    onclick="tryItOut('GETlog-viewer-logs--date--download');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer-logs--date--download"
                    onclick="cancelTryOut('GETlog-viewer-logs--date--download');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer-logs--date--download" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer/logs/{date}/download</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer-logs--date--download" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer-logs--date--download"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="GETlog-viewer-logs--date--download"
               value="laborum"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-GETlog-viewer-logs--date---level-">Filter the log entries by level.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer-logs--date---level-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer/logs/animi/tempora" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs/animi/tempora"
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

<span id="example-responses-GETlog-viewer-logs--date---level-">
            <blockquote>
            <p>Example response (404):</p>
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
    &quot;message&quot;: &quot;Log not found in this date [animi]&quot;,
    &quot;exception&quot;: &quot;Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException&quot;,
    &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php&quot;,
    &quot;line&quot;: 1145,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\helpers.php&quot;,
            &quot;line&quot;: 44,
            &quot;function&quot;: &quot;abort&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Http\\Controllers\\LogViewerController.php&quot;,
            &quot;line&quot;: 259,
            &quot;function&quot;: &quot;abort&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\arcanedev\\log-viewer\\src\\Http\\Controllers\\LogViewerController.php&quot;,
            &quot;line&quot;: 125,
            &quot;function&quot;: &quot;getLogOrFail&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php&quot;,
            &quot;line&quot;: 54,
            &quot;function&quot;: &quot;showByLevel&quot;,
            &quot;class&quot;: &quot;Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;callAction&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Controller&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 261,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\ControllerDispatcher&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php&quot;,
            &quot;line&quot;: 204,
            &quot;function&quot;: &quot;runController&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 725,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Routing\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 726,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 703,
            &quot;function&quot;: &quot;runRouteWithinStack&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 667,
            &quot;function&quot;: &quot;runRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 656,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 167,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\HandleCors&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 142,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 111,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 287,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 89,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 222,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 123,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 80,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 56,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php&quot;,
            &quot;line&quot;: 55,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php&quot;,
            &quot;line&quot;: 651,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 139,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Command\\Command.php&quot;,
            &quot;line&quot;: 308,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 124,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 998,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 171,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php&quot;,
            &quot;line&quot;: 129,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer-logs--date---level-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer-logs--date---level-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer-logs--date---level-"></code></pre>
</span>
<span id="execution-error-GETlog-viewer-logs--date---level-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer-logs--date---level-"></code></pre>
</span>
<form id="form-GETlog-viewer-logs--date---level-" data-method="GET"
      data-path="log-viewer/logs/{date}/{level}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer-logs--date---level-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer-logs--date---level-"
                    onclick="tryItOut('GETlog-viewer-logs--date---level-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer-logs--date---level-"
                    onclick="cancelTryOut('GETlog-viewer-logs--date---level-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer-logs--date---level-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer/logs/{date}/{level}</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer-logs--date---level-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer-logs--date---level-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="GETlog-viewer-logs--date---level-"
               value="animi"
               data-component="url" hidden>
    <br>

            </p>
                    <p>
                <b><code>level</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="level"
               data-endpoint="GETlog-viewer-logs--date---level-"
               value="tempora"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-GETlog-viewer-logs--date---level--search">Show the log with the search query.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETlog-viewer-logs--date---level--search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/log-viewer/logs/officiis/sed/search" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/log-viewer/logs/officiis/sed/search"
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

<span id="example-responses-GETlog-viewer-logs--date---level--search">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost/log-viewer/logs/officiis
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost/log-viewer/logs/officiis&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost/log-viewer/logs/officiis&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost/log-viewer/logs/officiis&quot;&gt;http://localhost/log-viewer/logs/officiis&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETlog-viewer-logs--date---level--search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlog-viewer-logs--date---level--search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlog-viewer-logs--date---level--search"></code></pre>
</span>
<span id="execution-error-GETlog-viewer-logs--date---level--search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlog-viewer-logs--date---level--search"></code></pre>
</span>
<form id="form-GETlog-viewer-logs--date---level--search" data-method="GET"
      data-path="log-viewer/logs/{date}/{level}/search"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlog-viewer-logs--date---level--search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlog-viewer-logs--date---level--search"
                    onclick="tryItOut('GETlog-viewer-logs--date---level--search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlog-viewer-logs--date---level--search"
                    onclick="cancelTryOut('GETlog-viewer-logs--date---level--search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlog-viewer-logs--date---level--search" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>log-viewer/logs/{date}/{level}/search</code></b>
        </p>
                <p>
            <label id="auth-GETlog-viewer-logs--date---level--search" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETlog-viewer-logs--date---level--search"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="GETlog-viewer-logs--date---level--search"
               value="officiis"
               data-component="url" hidden>
    <br>

            </p>
                    <p>
                <b><code>level</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="level"
               data-endpoint="GETlog-viewer-logs--date---level--search"
               value="sed"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-GETadmin-log-reader">GET admin/log-reader</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETadmin-log-reader">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/log-reader" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/log-reader"
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

<span id="example-responses-GETadmin-log-reader">
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
set-cookie: XSRF-TOKEN=eyJpdiI6InFXVWtsYXFnck5paFBiWXRORnVpQnc9PSIsInZhbHVlIjoiTjdjcVBUM2EycFNSemdhaGFFNjJ3Q3kwelBnZFoxYmRWV2hmWFJPZkcwVks4QzZhdDlBcXczS25zNnVoaWlQY1BET3VpR25xQ2VmK2VCNndmRE5nQnFSRWNmQXNKdXpBWEVLWVBoSjQxbVNZSEhrNXJKbnRiY3pwZFZiZWk5SWQiLCJtYWMiOiJjMGE0NzczZDIxMWJmMzllMWE3MjJiMzc4NzUxMDA3OTRkOTA0MGIwNTgzMTQ4ZmY4ZDgyZDUwZmE1NDM0NTlhIiwidGFnIjoiIn0%3D; expires=Thu, 25 Aug 2022 06:13:45 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6InYyRXRXY051K0t1OHN5enZNRmRNK0E9PSIsInZhbHVlIjoiMExMTEVlcXgvU2czZ0FvS2Q2cURPVEhJQlhNN2hGRnl0cCt0MnN3Y3ozcnFISUNEUlRrQkU3U3FEelB5QXQzbmV3T0MyRXRGVjU4cmsvWndmTEFsUFBHTytnMHdYTit3MWw3Q01GMU5HU3RUYzhKdmthUVdmTjRUTFpzRWN3QUEiLCJtYWMiOiIzZGVjMTgxY2QwZDMyYzhmZTcwNWNiNjNkOGVhNDM5NTRkYjg2Yjc0M2Q0NGZhODUxMzFkZGNkZjI3YTAxZTI1IiwidGFnIjoiIn0%3D; expires=Thu, 25 Aug 2022 06:13:45 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-log-reader" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-log-reader"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-log-reader"></code></pre>
</span>
<span id="execution-error-GETadmin-log-reader" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-log-reader"></code></pre>
</span>
<form id="form-GETadmin-log-reader" data-method="GET"
      data-path="admin/log-reader"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-log-reader', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-log-reader"
                    onclick="tryItOut('GETadmin-log-reader');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-log-reader"
                    onclick="cancelTryOut('GETadmin-log-reader');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-log-reader" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/log-reader</code></b>
        </p>
                <p>
            <label id="auth-GETadmin-log-reader" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETadmin-log-reader"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-POSTadmin-log-reader">POST admin/log-reader</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTadmin-log-reader">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/admin/log-reader" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/log-reader"
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

<span id="example-responses-POSTadmin-log-reader">
</span>
<span id="execution-results-POSTadmin-log-reader" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTadmin-log-reader"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTadmin-log-reader"></code></pre>
</span>
<span id="execution-error-POSTadmin-log-reader" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTadmin-log-reader"></code></pre>
</span>
<form id="form-POSTadmin-log-reader" data-method="POST"
      data-path="admin/log-reader"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTadmin-log-reader', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTadmin-log-reader"
                    onclick="tryItOut('POSTadmin-log-reader');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTadmin-log-reader"
                    onclick="cancelTryOut('POSTadmin-log-reader');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTadmin-log-reader" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>admin/log-reader</code></b>
        </p>
                <p>
            <label id="auth-POSTadmin-log-reader" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTadmin-log-reader"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETadmin-api-log-reader">GET admin/api/log-reader</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETadmin-api-log-reader">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/api/log-reader" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/api/log-reader"
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

<span id="example-responses-GETadmin-api-log-reader">
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
set-cookie: XSRF-TOKEN=eyJpdiI6IjFQbXdqT2hVazZZM3drUHV2UTFnNXc9PSIsInZhbHVlIjoiVnZ0MmFzdlgwWUM5QW1TelAwQktvWXN3c1JSL1RCZ25QNjZUdElGRWlhaWZxM2Zzd095dGhES1ZZd0lFb3RLdHBTdzNJN21PZitEV0lScjFCQkIrbnVQbHZpb1Y4eHR4ZE0wWUVFUEloSEd5bFhVNTdHUUtlbWF5OFFsN0hTam8iLCJtYWMiOiI2NzJlNjZiNmFlOTc1MDIyZTIzZDNhMDE5MWRhZmFjNDE4YzRjMDg1OWFlNWU2NjUwZDBhNjM2Y2I3YmM0ZTA0IiwidGFnIjoiIn0%3D; expires=Thu, 25 Aug 2022 06:13:45 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6Ii9IQU1xaHZKaHpDdHMwdzNjcXVWWEE9PSIsInZhbHVlIjoiM1dlMWhRMmZSWmVEdFBRNmw2RXZOeUEvWnVVdEx1U3YvZlYvOHFUQS9IMWcwRDNTeDVBb0ZBVGtWQ2NHOFJmTDlOYkdvZjB6c1lFQjk1YlByN0FmQU5SR0xLVkhrd3ZicEQ3SjBhZ3RxV1QyUU05YnU4REc5VUZ6a1FLV1lOMDAiLCJtYWMiOiJiODFmNzk0NjNjMjJkMDMwOTdhOTcwYTZhM2I1NjJmMmEyN2MzNWM1ZTA5OGZlZTFkYTNiYzBhY2VkOTFkNmUxIiwidGFnIjoiIn0%3D; expires=Thu, 25 Aug 2022 06:13:45 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-api-log-reader" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-api-log-reader"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-api-log-reader"></code></pre>
</span>
<span id="execution-error-GETadmin-api-log-reader" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-api-log-reader"></code></pre>
</span>
<form id="form-GETadmin-api-log-reader" data-method="GET"
      data-path="admin/api/log-reader"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-api-log-reader', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-api-log-reader"
                    onclick="tryItOut('GETadmin-api-log-reader');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-api-log-reader"
                    onclick="cancelTryOut('GETadmin-api-log-reader');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-api-log-reader" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/api/log-reader</code></b>
        </p>
                <p>
            <label id="auth-GETadmin-api-log-reader" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETadmin-api-log-reader"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="endpoints-GETmails---">[Mail] - Show</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETmails---">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/mails/15" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/15"
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

<span id="example-responses-GETmails---">
            <blockquote>
            <p>Example response (404):</p>
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
    &quot;message&quot;: &quot;&quot;,
    &quot;exception&quot;: &quot;Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException&quot;,
    &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\AbstractRouteCollection.php&quot;,
    &quot;line&quot;: 44,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\RouteCollection.php&quot;,
            &quot;line&quot;: 162,
            &quot;function&quot;: &quot;handleMatchedRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\AbstractRouteCollection&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 680,
            &quot;function&quot;: &quot;match&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\RouteCollection&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 667,
            &quot;function&quot;: &quot;findRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 656,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 167,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\HandleCors&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 142,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 111,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 287,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 89,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 222,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 123,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 80,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 56,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php&quot;,
            &quot;line&quot;: 55,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php&quot;,
            &quot;line&quot;: 651,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 139,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Command\\Command.php&quot;,
            &quot;line&quot;: 308,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 124,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 998,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 171,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php&quot;,
            &quot;line&quot;: 129,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETmails---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmails---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmails---"></code></pre>
</span>
<span id="execution-error-GETmails---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmails---"></code></pre>
</span>
<form id="form-GETmails---" data-method="GET"
      data-path="mails/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmails---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmails---"
                    onclick="tryItOut('GETmails---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmails---"
                    onclick="cancelTryOut('GETmails---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmails---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>mails/{}</code></b>
        </p>
                <p>
            <label id="auth-GETmails---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETmails---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="GETmails---"
               value="15"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-DELETEmails---">[Mail] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEmails---">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/mails/3" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/mails/3"
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

<span id="example-responses-DELETEmails---">
</span>
<span id="execution-results-DELETEmails---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEmails---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEmails---"></code></pre>
</span>
<span id="execution-error-DELETEmails---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEmails---"></code></pre>
</span>
<form id="form-DELETEmails---" data-method="DELETE"
      data-path="mails/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEmails---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEmails---"
                    onclick="tryItOut('DELETEmails---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEmails---"
                    onclick="cancelTryOut('DELETEmails---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEmails---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>mails/{}</code></b>
        </p>
                <p>
            <label id="auth-DELETEmails---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEmails---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="DELETEmails---"
               value="3"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-GETappointments---">GET appointments/{}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointments---">
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

<span id="example-responses-GETappointments---">
            <blockquote>
            <p>Example response (404):</p>
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
    &quot;message&quot;: &quot;&quot;,
    &quot;exception&quot;: &quot;Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException&quot;,
    &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\AbstractRouteCollection.php&quot;,
    &quot;line&quot;: 44,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\RouteCollection.php&quot;,
            &quot;line&quot;: 162,
            &quot;function&quot;: &quot;handleMatchedRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\AbstractRouteCollection&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 680,
            &quot;function&quot;: &quot;match&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\RouteCollection&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 667,
            &quot;function&quot;: &quot;findRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php&quot;,
            &quot;line&quot;: 656,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 167,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\HandleCors&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 142,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php&quot;,
            &quot;line&quot;: 111,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 287,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 89,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 45,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Strategies\\Responses\\ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 222,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 179,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Extracting\\Extractor.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 123,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 80,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\GroupedEndpoints\\GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 56,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\knuckleswtf\\scribe\\src\\Commands\\GenerateDocumentation.php&quot;,
            &quot;line&quot;: 55,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php&quot;,
            &quot;line&quot;: 651,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 139,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Command\\Command.php&quot;,
            &quot;line&quot;: 308,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php&quot;,
            &quot;line&quot;: 124,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 998,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 299,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\symfony\\console\\Application.php&quot;,
            &quot;line&quot;: 171,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php&quot;,
            &quot;line&quot;: 129,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;C:\\Users\\user\\Projects\\Aurora\\Aurora_back_end\\artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETappointments---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointments---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointments---"></code></pre>
</span>
<span id="execution-error-GETappointments---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointments---"></code></pre>
</span>
<form id="form-GETappointments---" data-method="GET"
      data-path="appointments/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointments---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointments---"
                    onclick="tryItOut('GETappointments---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointments---"
                    onclick="cancelTryOut('GETappointments---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointments---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointments/{}</code></b>
        </p>
                <p>
            <label id="auth-GETappointments---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointments---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="GETappointments---"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-PUTappointments---">Update the specified resource in storage.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments---">
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

<span id="example-responses-PUTappointments---">
</span>
<span id="execution-results-PUTappointments---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments---"></code></pre>
</span>
<span id="execution-error-PUTappointments---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments---"></code></pre>
</span>
<form id="form-PUTappointments---" data-method="PUT"
      data-path="appointments/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments---"
                    onclick="tryItOut('PUTappointments---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments---"
                    onclick="cancelTryOut('PUTappointments---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/{}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>appointments/{}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="PUTappointments---"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>clinic_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="clinic_id"
               data-endpoint="PUTappointments---"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>appointment_type_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="appointment_type_id"
               data-endpoint="PUTappointments---"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>primary_pathologist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="primary_pathologist_id"
               data-endpoint="PUTappointments---"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>specialist_id</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="specialist_id"
               data-endpoint="PUTappointments---"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>anesthetist_id</code></b>&nbsp;&nbsp;<small>number</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="anesthetist_id"
               data-endpoint="PUTappointments---"
               value="0"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date"
               data-endpoint="PUTappointments---"
               value=""
               data-component="body" hidden>
    <br>
<p>Must be a valid date.</p>
        </p>
                <p>
            <b><code>skip_coding</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
                <label data-endpoint="PUTappointments---" hidden>
            <input type="radio" name="skip_coding"
                   value="true"
                   data-endpoint="PUTappointments---"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="PUTappointments---" hidden>
            <input type="radio" name="skip_coding"
                   value="false"
                   data-endpoint="PUTappointments---"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

        </p>
        </form>

            <h2 id="endpoints-GETappointments-confirmation-status">Display a listing of all appointments per their confirmation_status.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETappointments-confirmation-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/appointments/confirmation-status" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"confirmation_status\": \"CANCELLED\",
    \"appointment_range\": \"FUTURE\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/confirmation-status"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "confirmation_status": "CANCELLED",
    "appointment_range": "FUTURE"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETappointments-confirmation-status">
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
<span id="execution-results-GETappointments-confirmation-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETappointments-confirmation-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETappointments-confirmation-status"></code></pre>
</span>
<span id="execution-error-GETappointments-confirmation-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETappointments-confirmation-status"></code></pre>
</span>
<form id="form-GETappointments-confirmation-status" data-method="GET"
      data-path="appointments/confirmation-status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETappointments-confirmation-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETappointments-confirmation-status"
                    onclick="tryItOut('GETappointments-confirmation-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETappointments-confirmation-status"
                    onclick="cancelTryOut('GETappointments-confirmation-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETappointments-confirmation-status" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>appointments/confirmation-status</code></b>
        </p>
                <p>
            <label id="auth-GETappointments-confirmation-status" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETappointments-confirmation-status"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>confirmation_status</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="confirmation_status"
               data-endpoint="GETappointments-confirmation-status"
               value="CANCELLED"
               data-component="body" hidden>
    <br>
<p>The appointment confirmation Status in request: PENDING,CONFIRMED,CANCELLED,MISSED. Must be one of <code>PENDING</code>, <code>CONFIRMED</code>, <code>CANCELED</code>, or <code>MISSED</code>.</p>
        </p>
                <p>
            <b><code>appointment_range</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="appointment_range"
               data-endpoint="GETappointments-confirmation-status"
               value="FUTURE"
               data-component="body" hidden>
    <br>
<p>The range off appointment to return: FUTURE,PAST,ALL. Must be one of <code>FUTURE</code>, <code>PAST</code>, or <code>ALL</code>.</p>
        </p>
        </form>

            <h2 id="endpoints-PUTappointments-confirmation-status--appointment_id-">Updated the Appointment &#039;confirmation_status&#039; along with the reason for the status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTappointments-confirmation-status--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/appointments/confirmation-status/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"confirmation_status\": \"CANCELLED\",
    \"confirmation_status_reason\": \"They patient was too sick to attend\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/appointments/confirmation-status/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "confirmation_status": "CANCELLED",
    "confirmation_status_reason": "They patient was too sick to attend"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTappointments-confirmation-status--appointment_id-">
</span>
<span id="execution-results-PUTappointments-confirmation-status--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTappointments-confirmation-status--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTappointments-confirmation-status--appointment_id-"></code></pre>
</span>
<span id="execution-error-PUTappointments-confirmation-status--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTappointments-confirmation-status--appointment_id-"></code></pre>
</span>
<form id="form-PUTappointments-confirmation-status--appointment_id-" data-method="PUT"
      data-path="appointments/confirmation-status/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTappointments-confirmation-status--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTappointments-confirmation-status--appointment_id-"
                    onclick="tryItOut('PUTappointments-confirmation-status--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTappointments-confirmation-status--appointment_id-"
                    onclick="cancelTryOut('PUTappointments-confirmation-status--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTappointments-confirmation-status--appointment_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>appointments/confirmation-status/{appointment_id}</code></b>
        </p>
                <p>
            <label id="auth-PUTappointments-confirmation-status--appointment_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTappointments-confirmation-status--appointment_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>appointment_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="appointment_id"
               data-endpoint="PUTappointments-confirmation-status--appointment_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the appointment.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>confirmation_status</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="confirmation_status"
               data-endpoint="PUTappointments-confirmation-status--appointment_id-"
               value="CANCELLED"
               data-component="body" hidden>
    <br>
<p>The appointment confirmation Status: PENDING,CONFIRMED,CANCELLED,MISSED. Must be one of <code>PENDING</code>, <code>CONFIRMED</code>, <code>CANCELED</code>, or <code>MISSED</code>.</p>
        </p>
                <p>
            <b><code>confirmation_status_reason</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="confirmation_status_reason"
               data-endpoint="PUTappointments-confirmation-status--appointment_id-"
               value="They patient was too sick to attend"
               data-component="body" hidden>
    <br>
<p>The reason this confirmation status was set.</p>
        </p>
        </form>

        <h1 id="patients">Patients</h1>

    

            <h2 id="patients-GETpatients">[Patient] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a lists of all patients</p>

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
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Dr.&quot;,
    &quot;first_name&quot;: &quot;Elmo&quot;,
    &quot;last_name&quot;: &quot;Prohaska&quot;,
    &quot;full_name&quot;: &quot;Elmo Prohaska&quot;,
    &quot;email&quot;: &quot;it@aurorasoftware.com.au&quot;,
    &quot;contact_number&quot;: &quot;02-9780-0650&quot;,
    &quot;gender&quot;: &quot;Undisclosed&quot;,
    &quot;date_of_birth&quot;: &quot;1971-01-06&quot;,
    &quot;address&quot;: &quot;3783 Ferry Springs&quot;,
    &quot;marital_status&quot;: &quot;Undisclosed&quot;,
    &quot;birth_place_code&quot;: &quot;South&quot;,
    &quot;country_of_birth&quot;: &quot;Saint Pierre and Miquelon&quot;,
    &quot;birth_state&quot;: &quot;Maryland&quot;,
    &quot;allergies&quot;: &quot;Totam necessitatibus est sed assumenda.&quot;,
    &quot;aborginality&quot;: 1,
    &quot;occupation&quot;: &quot;blanditiis&quot;,
    &quot;height&quot;: 195,
    &quot;weight&quot;: 120,
    &quot;preferred_contact_method&quot;: &quot;phone&quot;,
    &quot;appointment_confirm_method&quot;: &quot;email&quot;,
    &quot;send_recall_method&quot;: &quot;sms&quot;,
    &quot;kin_name&quot;: &quot;Jessica&quot;,
    &quot;kin_relationship&quot;: &quot;mother&quot;,
    &quot;kin_phone_number&quot;: &quot;04-1237-9345&quot;,
    &quot;clinical_alerts&quot;: &quot;03-4295-9955&quot;,
    &quot;created_at&quot;: &quot;2022-08-22 15:36:37&quot;,
    &quot;updated_at&quot;: &quot;2022-08-22 15:36:38&quot;,
    &quot;billing&quot;: {
        &quot;id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;medicare_number&quot;: null,
        &quot;medicare_reference_number&quot;: null,
        &quot;medicare_expiry_date&quot;: null,
        &quot;concession_number&quot;: null,
        &quot;concession_expiry_date&quot;: null,
        &quot;pension_number&quot;: null,
        &quot;pension_expiry_date&quot;: null,
        &quot;healthcare_card_number&quot;: null,
        &quot;healthcare_card_expiry_date&quot;: null,
        &quot;health_fund_id&quot;: null,
        &quot;health_fund_membership_number&quot;: null,
        &quot;health_fund_reference_number&quot;: null,
        &quot;health_fund_expiry_date&quot;: null,
        &quot;account_holder_type&quot;: &quot;Self&quot;,
        &quot;account_holder_id&quot;: null,
        &quot;fund_excess&quot;: null,
        &quot;created_at&quot;: &quot;2022-08-22 15:36:38&quot;,
        &quot;updated_at&quot;: &quot;2022-08-22 15:36:38&quot;
    },
    &quot;all_upcoming_appointments&quot;: &quot;appointments&quot;
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

            <h2 id="patients-GETpatients---">[Patient] - Show</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETpatients---">
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

<span id="example-responses-GETpatients---">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Dr.&quot;,
    &quot;first_name&quot;: &quot;Elmo&quot;,
    &quot;last_name&quot;: &quot;Prohaska&quot;,
    &quot;full_name&quot;: &quot;Elmo Prohaska&quot;,
    &quot;email&quot;: &quot;it@aurorasoftware.com.au&quot;,
    &quot;contact_number&quot;: &quot;02-9780-0650&quot;,
    &quot;gender&quot;: &quot;Undisclosed&quot;,
    &quot;date_of_birth&quot;: &quot;1971-01-06&quot;,
    &quot;address&quot;: &quot;3783 Ferry Springs&quot;,
    &quot;marital_status&quot;: &quot;Undisclosed&quot;,
    &quot;birth_place_code&quot;: &quot;South&quot;,
    &quot;country_of_birth&quot;: &quot;Saint Pierre and Miquelon&quot;,
    &quot;birth_state&quot;: &quot;Maryland&quot;,
    &quot;allergies&quot;: &quot;Totam necessitatibus est sed assumenda.&quot;,
    &quot;aborginality&quot;: 1,
    &quot;occupation&quot;: &quot;blanditiis&quot;,
    &quot;height&quot;: 195,
    &quot;weight&quot;: 120,
    &quot;preferred_contact_method&quot;: &quot;phone&quot;,
    &quot;appointment_confirm_method&quot;: &quot;email&quot;,
    &quot;send_recall_method&quot;: &quot;sms&quot;,
    &quot;kin_name&quot;: &quot;Jessica&quot;,
    &quot;kin_relationship&quot;: &quot;mother&quot;,
    &quot;kin_phone_number&quot;: &quot;04-1237-9345&quot;,
    &quot;clinical_alerts&quot;: &quot;03-4295-9955&quot;,
    &quot;created_at&quot;: &quot;2022-08-22 15:36:37&quot;,
    &quot;updated_at&quot;: &quot;2022-08-22 15:36:38&quot;,
    &quot;billing&quot;: {
        &quot;id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;medicare_number&quot;: null,
        &quot;medicare_reference_number&quot;: null,
        &quot;medicare_expiry_date&quot;: null,
        &quot;concession_number&quot;: null,
        &quot;concession_expiry_date&quot;: null,
        &quot;pension_number&quot;: null,
        &quot;pension_expiry_date&quot;: null,
        &quot;healthcare_card_number&quot;: null,
        &quot;healthcare_card_expiry_date&quot;: null,
        &quot;health_fund_id&quot;: null,
        &quot;health_fund_membership_number&quot;: null,
        &quot;health_fund_reference_number&quot;: null,
        &quot;health_fund_expiry_date&quot;: null,
        &quot;account_holder_type&quot;: &quot;Self&quot;,
        &quot;account_holder_id&quot;: null,
        &quot;fund_excess&quot;: null,
        &quot;created_at&quot;: &quot;2022-08-22 15:36:38&quot;,
        &quot;updated_at&quot;: &quot;2022-08-22 15:36:38&quot;
    },
    &quot;all_upcoming_appointments&quot;: &quot;appointments&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpatients---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients---"></code></pre>
</span>
<span id="execution-error-GETpatients---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients---"></code></pre>
</span>
<form id="form-GETpatients---" data-method="GET"
      data-path="patients/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients---"
                    onclick="tryItOut('GETpatients---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients---"
                    onclick="cancelTryOut('GETpatients---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/{}</code></b>
        </p>
                <p>
            <label id="auth-GETpatients---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatients---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="GETpatients---"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="patients-PUTpatients---">[Patient] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatients---">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patients/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"Miss\",
    \"first_name\": \"Jessica\",
    \"last_name\": \"Smith\",
    \"date_of_birth\": \"1993-10-09\",
    \"contact_number\": \"04-8234-2342\",
    \"gender\": \"Undisclosed\",
    \"address\": \"14 Panorama Dr, Mildura\",
    \"birth_place_code\": \"AU242\",
    \"country_of_birth\": \"Australia\",
    \"birth_state\": \"Victoria\",
    \"allergies\": \"Allergic rhinitis (hay fever), eczema, hives\",
    \"aborginality\": \"1\",
    \"occupation\": \"Student\",
    \"height\": \"175\",
    \"weight\": \"96\",
    \"appointment_confirm_method\": \"SMS\",
    \"send_recall_method\": \"MAIL\",
    \"kin_name\": \"Josh Doe\",
    \"kin_relationship\": \"Father\",
    \"kin_phone_number\": \"04-8234-2342\",
    \"clinical_alerts\": \"Jessica is permanently ina wheelchair\"
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
    "title": "Miss",
    "first_name": "Jessica",
    "last_name": "Smith",
    "date_of_birth": "1993-10-09",
    "contact_number": "04-8234-2342",
    "gender": "Undisclosed",
    "address": "14 Panorama Dr, Mildura",
    "birth_place_code": "AU242",
    "country_of_birth": "Australia",
    "birth_state": "Victoria",
    "allergies": "Allergic rhinitis (hay fever), eczema, hives",
    "aborginality": "1",
    "occupation": "Student",
    "height": "175",
    "weight": "96",
    "appointment_confirm_method": "SMS",
    "send_recall_method": "MAIL",
    "kin_name": "Josh Doe",
    "kin_relationship": "Father",
    "kin_phone_number": "04-8234-2342",
    "clinical_alerts": "Jessica is permanently ina wheelchair"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatients---">
</span>
<span id="execution-results-PUTpatients---" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatients---"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatients---"></code></pre>
</span>
<span id="execution-error-PUTpatients---" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatients---"></code></pre>
</span>
<form id="form-PUTpatients---" data-method="PUT"
      data-path="patients/{}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatients---', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatients---"
                    onclick="tryItOut('PUTpatients---');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatients---"
                    onclick="cancelTryOut('PUTpatients---');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatients---" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patients/{}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patients/{}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatients---" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatients---"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code></code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name=""
               data-endpoint="PUTpatients---"
               value="1"
               data-component="url" hidden>
    <br>

            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="title"
               data-endpoint="PUTpatients---"
               value="Miss"
               data-component="body" hidden>
    <br>
<p>The patients preferred title.</p>
        </p>
                <p>
            <b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="first_name"
               data-endpoint="PUTpatients---"
               value="Jessica"
               data-component="body" hidden>
    <br>
<p>The patients first name.</p>
        </p>
                <p>
            <b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="last_name"
               data-endpoint="PUTpatients---"
               value="Smith"
               data-component="body" hidden>
    <br>
<p>The patients last name.</p>
        </p>
                <p>
            <b><code>date_of_birth</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="date_of_birth"
               data-endpoint="PUTpatients---"
               value="1993-10-09"
               data-component="body" hidden>
    <br>
<p>The patients date of birth.</p>
        </p>
                <p>
            <b><code>contact_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="contact_number"
               data-endpoint="PUTpatients---"
               value="04-8234-2342"
               data-component="body" hidden>
    <br>
<p>The patients contact number.</p>
        </p>
                <p>
            <b><code>gender</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="gender"
               data-endpoint="PUTpatients---"
               value="Undisclosed"
               data-component="body" hidden>
    <br>
<p>The patients gender.</p>
        </p>
                <p>
            <b><code>address</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="address"
               data-endpoint="PUTpatients---"
               value="14 Panorama Dr, Mildura"
               data-component="body" hidden>
    <br>
<p>The patients address.</p>
        </p>
                <p>
            <b><code>marital_status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="marital_status"
               data-endpoint="PUTpatients---"
               value=""
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>birth_place_code</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="birth_place_code"
               data-endpoint="PUTpatients---"
               value="AU242"
               data-component="body" hidden>
    <br>
<p>The patients birth place code.</p>
        </p>
                <p>
            <b><code>country_of_birth</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="country_of_birth"
               data-endpoint="PUTpatients---"
               value="Australia"
               data-component="body" hidden>
    <br>
<p>The patients birth country.</p>
        </p>
                <p>
            <b><code>birth_state</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="birth_state"
               data-endpoint="PUTpatients---"
               value="Victoria"
               data-component="body" hidden>
    <br>
<p>The patients birth state.</p>
        </p>
                <p>
            <b><code>allergies</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="allergies"
               data-endpoint="PUTpatients---"
               value="Allergic rhinitis (hay fever), eczema, hives"
               data-component="body" hidden>
    <br>
<p>The patients allergies.</p>
        </p>
                <p>
            <b><code>aborginality</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="aborginality"
               data-endpoint="PUTpatients---"
               value="1"
               data-component="body" hidden>
    <br>
<p>Does the patient identify as an Aboriginal or Torres Strait Islander.</p>
        </p>
                <p>
            <b><code>occupation</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="occupation"
               data-endpoint="PUTpatients---"
               value="Student"
               data-component="body" hidden>
    <br>
<p>The patients occupation.</p>
        </p>
                <p>
            <b><code>height</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="height"
               data-endpoint="PUTpatients---"
               value="175"
               data-component="body" hidden>
    <br>
<p>The patients reported height (cm).</p>
        </p>
                <p>
            <b><code>weight</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="weight"
               data-endpoint="PUTpatients---"
               value="96"
               data-component="body" hidden>
    <br>
<p>The patients reported weight (kg).</p>
        </p>
                <p>
            <b><code>appointment_confirm_method</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="appointment_confirm_method"
               data-endpoint="PUTpatients---"
               value="SMS"
               data-component="body" hidden>
    <br>
<p>The patients preferred appointment confirm method.</p>
        </p>
                <p>
            <b><code>send_recall_method</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="send_recall_method"
               data-endpoint="PUTpatients---"
               value="MAIL"
               data-component="body" hidden>
    <br>
<p>The patients preferred send recall confirm method.</p>
        </p>
                <p>
            <b><code>kin_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="kin_name"
               data-endpoint="PUTpatients---"
               value="Josh Doe"
               data-component="body" hidden>
    <br>
<p>The patients next of kin name.</p>
        </p>
                <p>
            <b><code>kin_relationship</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="kin_relationship"
               data-endpoint="PUTpatients---"
               value="Father"
               data-component="body" hidden>
    <br>
<p>The patients next of kin relationship.</p>
        </p>
                <p>
            <b><code>kin_phone_number</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="kin_phone_number"
               data-endpoint="PUTpatients---"
               value="04-8234-2342"
               data-component="body" hidden>
    <br>
<p>The patients next of kin phone number.</p>
        </p>
                <p>
            <b><code>clinical_alerts</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="clinical_alerts"
               data-endpoint="PUTpatients---"
               value="Jessica is permanently ina wheelchair"
               data-component="body" hidden>
    <br>
<p>The patient clinical alerts.</p>
        </p>
        </form>

            <h2 id="patients-GETpatients-recalls--patient_id-">[Recall - List]</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a list of all the recalls set for the patient</p>

<span id="example-requests-GETpatients-recalls--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/patients/recalls/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/recalls/1"
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

<span id="example-responses-GETpatients-recalls--patient_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">[
    {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 5,
        &quot;organization_id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;time_frame&quot;: 1,
        &quot;date_recall_due&quot;: &quot;2022-09-25&quot;,
        &quot;confirmed&quot;: 0,
        &quot;reason&quot;: &quot;Please follow up on your colonoscopy&quot;,
        &quot;created_at&quot;: &quot;2022-08-25 12:00:30&quot;,
        &quot;updated_at&quot;: &quot;2022-08-25 12:00:30&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;user_id&quot;: 7,
        &quot;organization_id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;time_frame&quot;: 6,
        &quot;date_recall_due&quot;: &quot;2021-12-1&quot;,
        &quot;confirmed&quot;: 0,
        &quot;reason&quot;: &quot;Please book a consult&quot;,
        &quot;created_at&quot;: &quot;2021-06-1 12:00:30&quot;,
        &quot;updated_at&quot;: &quot;2021-06-1 12:00:30&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETpatients-recalls--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpatients-recalls--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpatients-recalls--patient_id-"></code></pre>
</span>
<span id="execution-error-GETpatients-recalls--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpatients-recalls--patient_id-"></code></pre>
</span>
<form id="form-GETpatients-recalls--patient_id-" data-method="GET"
      data-path="patients/recalls/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpatients-recalls--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpatients-recalls--patient_id-"
                    onclick="tryItOut('GETpatients-recalls--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpatients-recalls--patient_id-"
                    onclick="cancelTryOut('GETpatients-recalls--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpatients-recalls--patient_id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>patients/recalls/{patient_id}</code></b>
        </p>
                <p>
            <label id="auth-GETpatients-recalls--patient_id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETpatients-recalls--patient_id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>patient_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="patient_id"
               data-endpoint="GETpatients-recalls--patient_id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the patient.</p>
            </p>
                    </form>

            <h2 id="patients-POSTpatients-recalls">[Recall] - Store</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTpatients-recalls">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/patients/recalls" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": \"3\",
    \"time_frame\": \"6\",
    \"reason\": \"Please return for a follow up consolation\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/recalls"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": "3",
    "time_frame": "6",
    "reason": "Please return for a follow up consolation"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTpatients-recalls">
</span>
<span id="execution-results-POSTpatients-recalls" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTpatients-recalls"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTpatients-recalls"></code></pre>
</span>
<span id="execution-error-POSTpatients-recalls" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTpatients-recalls"></code></pre>
</span>
<form id="form-POSTpatients-recalls" data-method="POST"
      data-path="patients/recalls"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTpatients-recalls', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTpatients-recalls"
                    onclick="tryItOut('POSTpatients-recalls');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTpatients-recalls"
                    onclick="cancelTryOut('POSTpatients-recalls');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTpatients-recalls" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>patients/recalls</code></b>
        </p>
                <p>
            <label id="auth-POSTpatients-recalls" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTpatients-recalls"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="patient_id"
               data-endpoint="POSTpatients-recalls"
               value="3"
               data-component="body" hidden>
    <br>
<p>The id of the patient this recall is for</p>
        </p>
                <p>
            <b><code>time_frame</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="time_frame"
               data-endpoint="POSTpatients-recalls"
               value="6"
               data-component="body" hidden>
    <br>
<p>The time frame between now and when the recall should be sent in months</p>
        </p>
                <p>
            <b><code>reason</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="reason"
               data-endpoint="POSTpatients-recalls"
               value="Please return for a follow up consolation"
               data-component="body" hidden>
    <br>
<p>The reason for the recall</p>
        </p>
        </form>

            <h2 id="patients-PUTpatients-recalls--id-">[Recall] - Update</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTpatients-recalls--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/patients/recalls/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": \"3\",
    \"time_frame\": \"6\",
    \"reason\": \"Please return for a follow up consolation\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/recalls/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": "3",
    "time_frame": "6",
    "reason": "Please return for a follow up consolation"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTpatients-recalls--id-">
</span>
<span id="execution-results-PUTpatients-recalls--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTpatients-recalls--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTpatients-recalls--id-"></code></pre>
</span>
<span id="execution-error-PUTpatients-recalls--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTpatients-recalls--id-"></code></pre>
</span>
<form id="form-PUTpatients-recalls--id-" data-method="PUT"
      data-path="patients/recalls/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTpatients-recalls--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTpatients-recalls--id-"
                    onclick="tryItOut('PUTpatients-recalls--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTpatients-recalls--id-"
                    onclick="cancelTryOut('PUTpatients-recalls--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTpatients-recalls--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>patients/recalls/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>patients/recalls/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTpatients-recalls--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTpatients-recalls--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTpatients-recalls--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the recall.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>patient_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="patient_id"
               data-endpoint="PUTpatients-recalls--id-"
               value="3"
               data-component="body" hidden>
    <br>
<p>The id of the patient this recall is for</p>
        </p>
                <p>
            <b><code>time_frame</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="time_frame"
               data-endpoint="PUTpatients-recalls--id-"
               value="6"
               data-component="body" hidden>
    <br>
<p>The time frame between now and when the recall should be sent in months</p>
        </p>
                <p>
            <b><code>reason</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="reason"
               data-endpoint="PUTpatients-recalls--id-"
               value="Please return for a follow up consolation"
               data-component="body" hidden>
    <br>
<p>The reason for the recall</p>
        </p>
        </form>

            <h2 id="patients-DELETEpatients-recalls--id-">[Recall] - Destroy</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEpatients-recalls--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/patients/recalls/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/patients/recalls/1"
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

<span id="example-responses-DELETEpatients-recalls--id-">
</span>
<span id="execution-results-DELETEpatients-recalls--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEpatients-recalls--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEpatients-recalls--id-"></code></pre>
</span>
<span id="execution-error-DELETEpatients-recalls--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEpatients-recalls--id-"></code></pre>
</span>
<form id="form-DELETEpatients-recalls--id-" data-method="DELETE"
      data-path="patients/recalls/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEpatients-recalls--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEpatients-recalls--id-"
                    onclick="tryItOut('DELETEpatients-recalls--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEpatients-recalls--id-"
                    onclick="cancelTryOut('DELETEpatients-recalls--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEpatients-recalls--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>patients/recalls/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEpatients-recalls--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEpatients-recalls--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEpatients-recalls--id-"
               value="1"
               data-component="url" hidden>
    <br>
<p>The ID of the recall.</p>
            </p>
                    </form>

        <h1 id="settings">Settings</h1>

    

            <h2 id="settings-GETanesthetic-questions">[Anesthetic Question] - List</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>A list of all the organizations questions. These questions are used to asses the initial status of an appointments 'procedure_approval_status'</p>

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
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">[
    {
        &quot;id&quot;: 1,
        &quot;organization_id&quot;: 1,
        &quot;question&quot;: &quot;Do you have a pace-maker?&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;organization_id&quot;: 1,
        &quot;question&quot;: &quot;Have you had any major surgery&#039;s in the past 5 years?&quot;
    }
]</code>
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

            <h2 id="settings-POSTanesthetic-questions">[Anesthetic Question] - Store</h2>

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
    --header "Accept: application/json" \
    --data "{
    \"question\": \"\\\"Have you undergone any major surgeries?\\\"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "\"Have you undergone any major surgeries?\""
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
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
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>question</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question"
               data-endpoint="POSTanesthetic-questions"
               value=""Have you undergone any major surgeries?""
               data-component="body" hidden>
    <br>
<p>The text content for the anesthetic question</p>
        </p>
        </form>

            <h2 id="settings-PUTanesthetic-questions--id-">[Anesthetic Question] - Update</h2>

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
    --header "Accept: application/json" \
    --data "{
    \"question\": \"\\\"Have you undergone any major surgeries?\\\"\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/anesthetic-questions/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "\"Have you undergone any major surgeries?\""
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
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
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>question</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="question"
               data-endpoint="PUTanesthetic-questions--id-"
               value=""Have you undergone any major surgeries?""
               data-component="body" hidden>
    <br>
<p>The text content for the anesthetic question</p>
        </p>
        </form>

            <h2 id="settings-DELETEanesthetic-questions--id-">[Anesthetic Question] - Destroy</h2>

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
