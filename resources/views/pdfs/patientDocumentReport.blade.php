<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        html,
        body {
            margin: 0px;
            height: 100%;
        }

        footer {
            position: absolute;
            bottom: 0px;
        }

        section {
            padding: 20px 40px 30px 40px;
        }

        .light {
            color: gray;
            font-size: small;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ storage_path('app/' . $header_image) }}" style="width: 100%;">
    </header>
    <section>
        <h1>{{ $title }}</h1>
        <div>
            <p>Dear {{ $referringDoctor }}, Thank you for referring {{ $patientName }}</p>
        </div>
        @foreach ($reportData as $report)
            <h2>{{ $report[0] }}</h2>
            @foreach ($report[2] as $answer)
                <p>
                    {{ $answer }}
                </p>
            @endforeach
            <h3>{{ $report[1] }}</h3>
        @endforeach
        <div>

            <p>Report created by name at  {{ $date }}</p>
        </div>
    </section>
    <footer>
        <img src="{{ storage_path('app/' . $footer_image) }}" style="width: 100%;">
    </footer>
</body>

</html>
