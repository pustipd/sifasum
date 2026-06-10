<style>
    .popup {
        position: fixed;
        top: 2rem;
        left: 50%;
        transform: translateX(-50%);

        min-width: 300px;
        max-width: 600px;

        padding: 1rem 1.5rem;
        border-radius: 8px;
        text-align: center;

        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,.15);

        animation: slideDown .3s ease;
    }

    .popup-success {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .popup-error {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translate(-50%, -20px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
</style>

@if(session('success'))
    <div class="popup popup-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="popup popup-error">
        {{ session('error') }}
    </div>
@endif
