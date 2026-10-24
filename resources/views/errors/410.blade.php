<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>410 · Page Gone | {{ config('app.name') }}</title>
  <meta name="robots" content="noindex, nofollow" />
  <!-- Google Fonts: clean sans-serif & subtle elegance -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(145deg, #f8fafc 0%, #eef2f5 100%);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      margin: 0;
    }

    /* main error card — soft, elevated but minimal */
    .error-container {
      max-width: 620px;
      width: 100%;
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(0px);
      background: #ffffff;
      border-radius: 2rem;
      box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08), 0 2px 6px rgba(0, 0, 0, 0.02);
      transition: all 0.2s ease;
      border: 1px solid rgba(203, 213, 225, 0.4);
    }

    .card-inner {
      padding: 3rem 2.5rem;
      text-align: center;
    }

    /* subtle status badge */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: #f1f5f9;
      padding: 0.4rem 1rem;
      border-radius: 60px;
      font-size: 0.85rem;
      font-weight: 500;
      letter-spacing: 0.3px;
      color: #1e293b;
      margin-bottom: 2rem;
      border: 1px solid #e2e8f0;
    }

    .status-badge span:first-child {
      font-weight: 700;
      background: #eef2ff;
      padding: 0.2rem 0.5rem;
      border-radius: 40px;
      font-size: 0.8rem;
      color: #1e40af;
    }

    /* 410 main heading */
    .error-code {
      font-size: 6rem;
      font-weight: 700;
      letter-spacing: -0.03em;
      background: linear-gradient(135deg, #0f172a, #334155);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      line-height: 1.1;
      margin-bottom: 0.75rem;
    }

    .error-title {
      font-size: 1.9rem;
      font-weight: 600;
      color: #0f172a;
      margin-bottom: 1rem;
      letter-spacing: -0.01em;
    }

    .error-message {
      font-size: 1rem;
      line-height: 1.5;
      color: #334155;
      max-width: 420px;
      margin: 0 auto 2rem auto;
      font-weight: 400;
    }

    .error-message strong {
      font-weight: 600;
      color: #0f172a;
      background: #f1f5f9;
      padding: 0.1rem 0.3rem;
      border-radius: 8px;
      font-family: monospace;
      font-size: 0.95rem;
    }

    /* simple decorative divider */
    .divider-light {
      width: 64px;
      height: 2px;
      background: #cbd5e1;
      margin: 1.5rem auto 1.8rem auto;
      border-radius: 2px;
      opacity: 0.6;
    }

    /* action buttons — clean, minimal but inviting */
    .actions {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      margin-top: 0.5rem;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.7rem 1.6rem;
      border-radius: 60px;
      font-weight: 500;
      font-size: 0.95rem;
      text-decoration: none;
      transition: all 0.2s ease;
      cursor: pointer;
      border: 1px solid transparent;
      background: transparent;
      font-family: inherit;
    }

    .btn-primary {
      background: #0f172a;
      color: white;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
      border: 1px solid #1e293b;
    }

    .btn-primary:hover {
      background: #1e293b;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px -8px rgba(15, 23, 42, 0.25);
    }

    .btn-secondary {
      background: #ffffff;
      border: 1px solid #cbd5e1;
      color: #1e293b;
    }

    .btn-secondary:hover {
      background: #f8fafc;
      border-color: #94a3b8;
      transform: translateY(-1px);
    }

    /* subtle ghost icon via pseudo (simple arrow / home symbol) */
    .btn-primary .home-icon,
    .btn-secondary .search-icon {
      font-size: 1.1rem;
      line-height: 1;
    }

    /* support text & timestamp (optional neat detail) */
    .footnote {
      margin-top: 2.2rem;
      font-size: 0.75rem;
      color: #64748b;
      border-top: 1px solid #e9eef3;
      padding-top: 1.5rem;
      display: flex;
      justify-content: center;
      gap: 1.2rem;
      flex-wrap: wrap;
    }

    .footnote span {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
    }

    /* responsive */
    @media (max-width: 540px) {
      .card-inner {
        padding: 2rem 1.5rem;
      }
      .error-code {
        font-size: 4.5rem;
      }
      .error-title {
        font-size: 1.6rem;
      }
      .btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.85rem;
      }
    }

    /* illustration touch: small dot pattern (subtle) */
    .error-container {
      position: relative;
      overflow: hidden;
    }

    .error-container::before {
      content: '';
      position: absolute;
      top: -20%;
      right: -20%;
      width: 240px;
      height: 240px;
      background: radial-gradient(circle, rgba(148, 163, 184, 0.08) 0%, rgba(148, 163, 184, 0) 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .error-container::after {
      content: '';
      position: absolute;
      bottom: -20%;
      left: -10%;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(100, 116, 139, 0.05) 0%, rgba(100, 116, 139, 0) 70%);
      border-radius: 50%;
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="error-container">
    <div class="card-inner">
      <!-- status chip: clean indicator -->
      <div class="status-badge">
        <span>HTTP 410</span>
        <span>Gone · Permanent</span>
      </div>

      <!-- main visual: code + title -->
      <div class="error-code">410</div>
      <div class="error-title">This page has vanished</div>
      <div class="error-message">
        The resource you're looking for <strong>has been permanently removed</strong> from this server. No forwarding address — it’s gone for good.
      </div>

      <!-- minimal divider (gentle rhythm) -->
      <div class="divider-light"></div>

      <!-- CTA group: helpful and clear -->
      <div class="actions text-center">
        <a href="/" class="btn btn-primary">
          <span class="home-icon">←</span> Back to homepage
        </a>
      </div>
    </div>
  </div>
</body>
</html>