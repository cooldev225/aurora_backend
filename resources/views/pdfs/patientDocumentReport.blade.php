<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div>
        <span>Date</span><p>{{ $date }}</p>
    </div>
    <div>
        <p>Dear {{$referringDoctor}}, Thank you for referring {{$patientName}}</p>
    </div>
    @foreach ($reportData as $report)
        <h2>{{ $report[0]}}</h2>
        @foreach ($report[2] as $answer)
          <p>
            {{$answer}}
          </p>
        @endforeach
        <h3>{{ $report[1]}}</h3>

    @endforeach

</body>
</html>
