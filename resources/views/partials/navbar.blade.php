<nav style="
    padding: 18px 24px;
    background-color: white;
    border-bottom: 1px solid #dddddd;
">
    <div style="
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    ">
        <a
            href="{{ route('home') }}"
            style="
                color: #111827;
                font-size: 20px;
                font-weight: bold;
                text-decoration: none;
            "
        >
            Portofolio Saya
        </a>

        <div style="
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        ">
            <a
                href="{{ route('home') }}"
                style="color: #2563eb; text-decoration: none;"
            >
                Home
            </a>

            <a
                href="{{ route('about') }}"
                style="color: #2563eb; text-decoration: none;"
            >
                About
            </a>

            <a
                href="{{ route('education') }}"
                style="color: #2563eb; text-decoration: none;"
            >
                Education
            </a>

            <a
                href="{{ route('projects.index') }}"
                style="color: #2563eb; text-decoration: none;"
            >
                Projects
            </a>
        </div>
    </div>
</nav>