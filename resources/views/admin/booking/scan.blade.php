<x-layouts.admin title="Scan QR Code Check-in">
    <div class="h-[calc(100vh-6rem)] flex flex-col md:flex-row gap-6">
        <!-- Left Column: Scanner -->
        <div class="flex-1 flex flex-col">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Scan QR Code</h2>
                    <p class="text-gray-500 text-sm">Arahkan kamera ke QR Code tamu</p>
                </div>
                <x-ui.button variant="secondary" size="sm" href="{{ route('admin.booking.index') }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </x-ui.button>
            </div>

            <x-ui.card
                class="flex-1 flex flex-col justify-center bg-gray-900 border-0 overflow-hidden relative shadow-2xl">
                <div class="absolute inset-0 z-0">
                    <div id="reader" class="w-full h-full object-cover opacity-80"></div>
                </div>

                <!-- Overlay UI -->
                <div class="absolute inset-0 z-10 pointer-events-none flex flex-col items-center justify-center">
                    <!-- Scanner Frame -->
                    <div
                        class="relative w-64 h-64 md:w-80 md:h-80 border-2 border-white/30 rounded-3xl overflow-hidden backdrop-blur-sm">
                        <!-- Corner Markers -->
                        <div
                            class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-primary-500 rounded-tl-xl">
                        </div>
                        <div
                            class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-primary-500 rounded-tr-xl">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-primary-500 rounded-bl-xl">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-primary-500 rounded-br-xl">
                        </div>

                        <!-- Scanning Animation -->
                        <div
                            class="absolute inset-x-0 h-1 bg-primary-500/80 shadow-[0_0_10px_rgba(59,130,246,0.5)] animate-scan top-0">
                        </div>
                    </div>

                    <p class="mt-8 text-white/90 font-medium bg-black/50 px-4 py-2 rounded-full backdrop-blur text-sm">
                        Posisikan QR Code di dalam kotak
                    </p>
                </div>

                <!-- Loading / Processing Status -->
                <div id="loading-indicator"
                    class="hidden absolute inset-0 z-20 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                    <div class="bg-white p-6 rounded-2xl shadow-xl flex flex-col items-center">
                        <div
                            class="animate-spin rounded-full h-10 w-10 border-4 border-primary-100 border-t-primary-600 mb-4">
                        </div>
                        <h3 class="text-gray-900 font-bold mb-1">Memproses...</h3>
                        <p class="text-gray-500 text-sm">Mohon tunggu sebentar</p>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Right Column: Result & History -->
        <div class="w-full md:w-96 flex flex-col gap-6">
            <!-- Active Result Card -->
            <div id="scan-result" class="hidden animate-fade-in-up">
                <x-ui.card class="border-t-4 border-t-primary-500 shadow-lg">
                    <div class="text-center mb-6">
                        <div id="result-icon-container"
                            class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-3 transition-colors duration-300">
                            <!-- Icons injected by JS -->
                        </div>
                        <h3 id="result-title" class="text-xl font-bold text-gray-900">Scan Berhasil</h3>
                        <p id="result-message" class="text-gray-600 text-sm mt-1">Booking berhasil dicheck-in.</p>
                    </div>

                    <div id="booking-details" class="space-y-3 bg-gray-50 p-4 rounded-xl mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Tamu</span>
                            <span id="guest-name" class="font-semibold text-gray-900 text-right truncate ml-2"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Kavling</span>
                            <span id="kavling-name" class="font-semibold text-gray-900"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Kode</span>
                            <span id="booking-code"
                                class="font-mono text-xs bg-white border px-2 py-0.5 rounded text-gray-700"></span>
                        </div>
                    </div>

                    <button onclick="resumeScanning()"
                        class="w-full py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-semibold shadow-md shadow-primary-200 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Scan Berikutnya
                    </button>
                </x-ui.card>
            </div>

            <!-- Idle State / Instructions -->
            <div id="idle-state"
                class="flex-1 flex flex-col items-center justify-center text-center p-8 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 text-gray-400">
                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <h4 class="font-semibold text-gray-500">Siap Memindai</h4>
                <p class="text-sm mt-1">Hasil scan akan muncul di sini</p>
            </div>

            <!-- Session History -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col max-h-[300px]">
                <div class="p-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800 text-sm">Riwayat Sesi Ini</h3>
                </div>
                <div id="scan-history"
                    class="overflow-y-auto p-2 space-y-2 flex-1 empty:p-8 empty:flex empty:items-center empty:justify-center">
                    <p class="text-xs text-center text-gray-400 italic empty-msg">Belum ada riwayat scan</p>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .animate-scan {
                animation: scan-line 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            }

            @keyframes scan-line {
                0% {
                    top: 0%;
                    opacity: 0;
                }

                10% {
                    opacity: 1;
                }

                90% {
                    opacity: 1;
                }

                100% {
                    top: 100%;
                    opacity: 0;
                }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.3s ease-out forwards;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #reader video {
                object-fit: cover !important;
                border-radius: 0.5rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            const html5QrCode = new Html5Qrcode("reader");
            let isScanning = true;
            let isProcessing = false;
            let scanHistory = [];

            // Audio Context for Beep
            const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            function playBeep(success = true) {
                if (audioCtx.state === 'suspended') audioCtx.resume();
                const oscillator = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                oscillator.connect(gainNode);
                gainNode.connect(audioCtx.destination);
                oscillator.type = 'sine';
                oscillator.frequency.setValueAtTime(success ? 880 : 300, audioCtx.currentTime);
                gainNode.gain.setValueAtTime(0.1, audioCtx.currentTime);
                oscillator.start();
                setTimeout(() => oscillator.stop(), success ? 200 : 500);
            }

            function onScanSuccess(decodedText, decodedResult) {
                if (!isScanning || isProcessing) return;

                isProcessing = true;
                html5QrCode.pause();
                document.getElementById('loading-indicator').classList.remove('hidden');

                fetch('{{ route('admin.booking.scan-action') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code: decodedText })
                })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('loading-indicator').classList.add('hidden');
                        const success = data.status === 'success';
                        handleScanResult(success, data);
                        playBeep(success);
                    })
                    .catch(error => {
                        document.getElementById('loading-indicator').classList.add('hidden');
                        handleScanResult(false, { message: 'Terjadi kesalahan sistem.', action: 'error' });
                        playBeep(false);
                    });
            }

            function addToHistory(data, success) {
                const historyContainer = document.getElementById('scan-history');
                const emptyMsg = historyContainer.querySelector('.empty-msg');
                if (emptyMsg) emptyMsg.remove();

                const time = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                const statusColor = success ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50';

                const item = document.createElement('div');
                item.className = 'flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition border border-gray-100';
                item.innerHTML = `
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center ${statusColor}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        ${success
                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
                        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'}
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">${data.booking ? data.booking.user.name : 'Unknown'}</p>
                                    <p class="text-xs text-gray-500">${data.booking ? data.booking.code : '-'}</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">${time}</span>
                        `;

                historyContainer.prepend(item);
            }

            function handleScanResult(success, data) {
                const idleState = document.getElementById('idle-state');
                const resultCard = document.getElementById('scan-result');
                const resultIconContainer = document.getElementById('result-icon-container');
                const title = document.getElementById('result-title');
                const msg = document.getElementById('result-message');
                const bookingDetails = document.getElementById('booking-details');

                idleState.classList.add('hidden');
                resultCard.classList.remove('hidden');

                // Icon & Color Logic
                if (success) {
                    if (data.action === 'check_out') {
                        resultIconContainer.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-3 text-blue-600';
                        resultIconContainer.innerHTML = `<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>`;
                        title.innerText = 'Check-out Berhasil';
                        title.className = 'text-xl font-bold text-blue-700';
                    } else {
                        resultIconContainer.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-3 text-green-600';
                        resultIconContainer.innerHTML = `<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;
                        title.innerText = 'Check-in Berhasil';
                        title.className = 'text-xl font-bold text-green-700';
                    }
                    bookingDetails.classList.remove('hidden');
                } else {
                    resultIconContainer.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-3 text-red-600';
                    resultIconContainer.innerHTML = `<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>`;
                    title.innerText = 'Gagal Memproses';
                    title.className = 'text-xl font-bold text-red-700';
                    bookingDetails.classList.add('hidden');
                }

                msg.innerText = data.message;

                if (data.booking) {
                    document.getElementById('guest-name').innerText = data.booking.user ? data.booking.user.name : '-';
                    document.getElementById('kavling-name').innerText = data.booking.kavling ? data.booking.kavling.nama : '-';
                    document.getElementById('booking-code').innerText = data.booking.code;
                }

                addToHistory(data, success);
            }

            function resumeScanning() {
                document.getElementById('scan-result').classList.add('hidden');
                document.getElementById('idle-state').classList.remove('hidden');
                isScanning = true;
                isProcessing = false;
                html5QrCode.resume();
            }

            function onScanFailure(error) {
                // Ignore frequent errors
            }

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    // Prefer back/rear camera for better quality
                    let cameraId = devices[0].id;
                    for (let device of devices) {
                        if (device.label.toLowerCase().includes('back') ||
                            device.label.toLowerCase().includes('rear') ||
                            device.label.toLowerCase().includes('environment')) {
                            cameraId = device.id;
                            break;
                        }
                    }

                    html5QrCode.start(
                        cameraId,
                        {
                            fps: 10,
                            qrbox: { width: 300, height: 300 },
                            // Remove aspectRatio to use native resolution
                            // This prevents excessive zoom
                            disableFlip: false,
                        },
                        onScanSuccess,
                        onScanFailure
                    ).catch(err => {
                        console.error("Error starting scanner", err);
                    });
                }
            }).catch(err => {
                console.error("Error getting cameras", err);
            });
        </script>
    @endpush
</x-layouts.admin>