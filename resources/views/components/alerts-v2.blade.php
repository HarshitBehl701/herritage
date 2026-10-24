<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 15px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;
        max-width: 420px;
        padding: 0 16px;
        pointer-events: none;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .alert {
        pointer-events: auto;
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        border-left: 4px solid transparent;
        animation: slideRight 0.3s ease forwards;

    }

    .alert.hide {
        animation: slideOutRight 0.25s ease forwards;

    }

    .alert-success {
        border-left-color: #10b981;
    }

    .alert-danger {
        border-left-color: #ef4444;
    }

    .alert-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        font-size: 16px;
        line-height: 1;
    }

    .alert-success .alert-icon {
        color: #10b981;
    }

    .alert-danger .alert-icon {
        color: #ef4444;
    }

    .alert-message {
        flex: 1;
        font-size: 13.5px;
        line-height: 1.4;
        color: #1f2937;
    }

    .alert-message strong {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 2px;
        color: #111827;
    }

    .alert-message ul {
        margin: 6px 0 0 0;
        padding-left: 18px;
    }

    .alert-message li {
        margin: 3px 0;
    }

    .close-btn {
        flex-shrink: 0;
        background: none;
        border: none;
        color: #9ca3af;
        font-size: 16px;
        width: 20px;
        height: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        line-height: 1;
        transition: color 0.2s ease;
    }

    .close-btn:hover {
        color: #374151;
    }

    @keyframes slideRight {
        from {
            transform: translateX(-40px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(40px);
            opacity: 0;
        }
    }

    @media (max-width: 640px) {
        .toast-container {
            top: 12px;
            padding: 0 12px;
        }

        .alert {
            padding: 12px 14px;
        }
    }
</style>

<div class="toast-container" id="toastContainer">
    {{-- ✅ Success --}}
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-icon">✔</div>
            <div class="alert-message">
                <strong>Success</strong>
                {{ session('success') }}
            </div>
            <button class="close-btn" onclick="closeAlert(this)">×</button>
        </div>
    @endif

    {{-- ❌ Error --}}
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-icon">✕</div>
            <div class="alert-message">
                <strong>Error</strong>
                {{ session('error') }}
            </div>
            <button class="close-btn" onclick="closeAlert(this)">×</button>
        </div>
    @endif

    {{-- ⚠️ Validation --}}
    @if (!empty($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="alert-icon">!</div>
            <div class="alert-message">
                <strong>Please fix the following</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="close-btn" onclick="closeAlert(this)">×</button>
        </div>
    @endif
</div>

<script>
    function closeAlert(button) {
        const alert = button.closest('.alert');
        if (!alert) return;
        alert.classList.add('hide');
        setTimeout(() => alert.remove(), 250);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.alert').forEach((alert) => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    const btn = alert.querySelector('.close-btn');
                    if (btn) closeAlert(btn);
                }
            }, 5000);
        });
    });

    window.showGlossyToast = function (type, message, duration = 5000) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
        toast.setAttribute('role', 'alert');

        const config = {
            success: { icon: '✔', title: 'Success' },
            error: { icon: '✕', title: 'Error' },
            danger: { icon: '!', title: 'Please fix the following' }
        };
        const { icon, title } = config[type] || { icon: 'i', title: 'Notice' };

        toast.innerHTML = `
            <div class="alert-icon">${icon}</div>
            <div class="alert-message">
                <strong>${title}</strong>
                ${message}
            </div>
            <button class="close-btn" onclick="closeAlert(this)">×</button>
        `;

        container.appendChild(toast);
        setTimeout(() => {
            if (toast && toast.parentNode) closeAlert(toast.querySelector('.close-btn'));
        }, duration);

        return toast;
    };
</script>