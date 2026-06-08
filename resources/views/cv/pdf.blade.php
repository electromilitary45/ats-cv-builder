<!DOCTYPE html>
<html lang="{{ $cv->language }}">

<head>
    <meta charset="utf-8">

    <style>
        @page {
            margin: 42px 46px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            font-size: 11px;
            line-height: 1.45;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #9ca3af;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .name {
            font-size: 21px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .title {
            margin-top: 5px;
            font-size: 12px;
            font-weight: bold;
            color: #374151;
        }

        .contact {
            margin-top: 8px;
            font-size: 9.5px;
            color: #374151;
        }

        .section {
            margin-top: 16px;
        }

        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 3px;
            margin-bottom: 8px;
        }

        .item {
            margin-bottom: 11px;
        }

        .item-title {
            font-size: 11px;
            font-weight: bold;
        }

        .item-subtitle {
            margin-top: 2px;
            font-size: 10px;
            color: #374151;
        }

        .summary {
            font-size: 10.5px;
            text-align: justify;
        }

        ul {
            margin: 5px 0 0 16px;
            padding: 0;
        }

        li {
            margin-bottom: 3px;
            padding-left: 2px;
        }

        .muted {
            color: #6b7280;
        }

        .skills p,
        .languages p {
            margin-bottom: 3px;
        }

        a {
            color: #111827;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 class="name">
            {{ $cv->full_name }}
        </h1>

        @if ($cv->professional_title)
        <p class="title">
            {{ $cv->professional_title }}
        </p>
        @endif

        <p class="contact">
            {{ collect([
                $cv->email,
                $cv->phone,
                $cv->location,
                $cv->linkedin,
                $cv->github,
            ])->filter()->join(' | ') }}
        </p>
    </div>

    @if ($cv->professional_summary)
    <section class="section">
        <h2 class="section-title">
            {{ $cv->label('professional_summary') }}
        </h2>

        <p class="summary">
            {{ $cv->professional_summary }}
        </p>
    </section>
    @endif

    <section class="section">
        <h2 class="section-title">
            {{ $cv->label('work_experience') }}
        </h2>

        @forelse ($cv->workExperiences as $experience)
        <article class="item">
            <h3 class="item-title">
                {{ $experience->position }}
            </h3>

            <p class="item-subtitle">
                {{ collect([
                    $experience->company,
                    $experience->location,
                    $cv->dateRange($experience->start_date, $experience->end_date, $experience->is_current),
                ])->filter()->join(' - ') }}
            </p>

            @if ($experience->description)
            <ul>
                @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                @if (trim($line))
                <li>{{ ltrim(trim($line), '-• ') }}</li>
                @endif
                @endforeach
            </ul>
            @endif
        </article>
        @empty
        <p class="muted">
            {{ $cv->label('no_work_experience') }}
        </p>
        @endforelse
    </section>

    <section class="section">
        <h2 class="section-title">
            {{ $cv->label('education') }}
        </h2>

        @forelse ($cv->educations as $education)
        <article class="item">
            <h3 class="item-title">
                {{ $education->degree }}
            </h3>

            <p class="item-subtitle">
                {{ collect([
                    $education->institution,
                    $education->location,
                    $cv->dateRange($education->start_date, $education->end_date),
                ])->filter()->join(' - ') }}
            </p>

            @if ($education->description)
            <p style="margin-top: 5px;">
                {{ $education->description }}
            </p>
            @endif
        </article>
        @empty
        <p class="muted">
            {{ $cv->label('no_education') }}
        </p>
        @endforelse
    </section>

    <section class="section skills">
        <h2 class="section-title">
            {{ $cv->label('skills') }}
        </h2>

        @if ($cv->skills->isNotEmpty())
        @foreach ($cv->skills->groupBy('category') as $category => $skills)
        <p>
            @if ($category)
            <strong>{{ $category }}:</strong>
            @endif

            {{ $skills->pluck('name')->join(', ') }}
        </p>
        @endforeach
        @else
        <p class="muted">
            {{ $cv->label('no_skills') }}
        </p>
        @endif
    </section>

    @if ($cv->certifications->isNotEmpty())
    <section class="section">
        <h2 class="section-title">
            {{ $cv->label('certifications') }}
        </h2>

        @foreach ($cv->certifications as $certification)
        <article class="item">
            <h3 class="item-title">
                {{ $certification->name }}
            </h3>

            <p class="item-subtitle">
                {{ collect([
                            $certification->issuer,
                            $cv->monthYear($certification->issued_at),
                        ])->filter()->join(' - ') }}
            </p>

            @if ($certification->url)
            <p style="font-size: 9.5px; margin-top: 2px;">
                {{ $certification->url }}
            </p>
            @endif
        </article>
        @endforeach
    </section>
    @endif

    @if ($cv->languages->isNotEmpty())
    <section class="section languages">
        <h2 class="section-title">
            {{ $cv->label('languages') }}
        </h2>

        @foreach ($cv->languages as $language)
        <p>
            <strong>{{ $language->name }}:</strong>
            {{ collect([$language->level, $language->certification])->filter()->join(' - ') }}
        </p>
        @endforeach
    </section>
    @endif
</body>

</html>
