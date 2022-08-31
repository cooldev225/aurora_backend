<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Submitted: {{ $date }}</p>

    @foreach ($preadmissionData as $section)
        <h2>{{ $section->section_title}}</h2>
        @foreach ($section->section_questions as $question)
          <p>
          {{ $question->question_text }}:
          
            @if (property_exists($question, 'question_answer')) {{ $question->question_answer}} @endif
          </p>
        @endforeach

    @endforeach

</body>
</html>