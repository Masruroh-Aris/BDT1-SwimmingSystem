<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body class="bg-gray-100 p-4">
    <script>
        async function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const contentElement = document.querySelector('.max-w-7xl');

            // Hide export button temporarily
            const exportBtn = document.querySelector('button');
            exportBtn.style.display = 'none';

            try {
                // Capture the content as canvas
                const canvas = await html2canvas(contentElement, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#f3f4f6'
                });

                // Create PDF
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a4'
                });

                const imgWidth = 297; // A4 landscape width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                pdf.save('Event_Schedule.pdf');
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF. Please try again.');
            } finally {
                // Show export button again
                exportBtn.style.display = 'inline-flex';
            }
        }
    </script>
    <!-- Export Button -->
    <div class="text-right">
        <button onclick="exportToPDF()"
            class="mb-4 bg-gradient-to-br from-red-600 to-red-900 text-white px-6 py-2.5 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 inline-flex items-center gap-2">
            <i class="fas fa-file-pdf"></i>
            Export to PDF
        </button>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-4">
                <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-xs text-center overflow-hidden">
                    <img src="{{ asset('images/prsi-logo.png') }}" alt="PSRI Logo" class="w-full h-full object-contain p-1">
                </div>
                <div class="flex-1 text-center px-4">
                    <h4 class="text-sm font-semibold leading-tight">{{ $meet->name }}</h4>
                    <h4 class="text-sm font-semibold leading-tight">{{ $meet->venue }}</h4>
                    <p class="text-xs text-gray-600 mt-1">
                        {{ $meet->start_date ? $meet->start_date->format('d M Y') : 'TBA' }} - 
                        {{ $meet->end_date ? $meet->end_date->format('d M Y') : 'TBA' }}
                    </p>
                </div>
                <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-xs text-center overflow-hidden">
                    @if($meet->logo)
                        <img src="{{ asset($meet->logo) }}" alt="Meet Logo" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px] text-gray-500">MEET LOGO</span>
                    @endif
                </div>
            </div>

            <div class="mb-4 text-center">
                <h3 class="text-xl font-bold">SCHEDULE</h3>
                <p class="text-base font-semibold text-gray-700">ALL SESSIONS</p>
            </div>

            <!-- Session Section (Simplified to single block for now) -->
            <div class="mb-6">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-xs" style="border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th
                                    style="border: 1px solid #d1d5db; padding: 12px 8px; text-align: center; font-weight: bold;">
                                    SYSTEM</th>
                                <th
                                    style="border: 1px solid #d1d5db; padding: 12px 8px; text-align: left; font-weight: bold;">
                                    DESCRIPTION</th>
                                <th
                                    style="border: 1px solid #d1d5db; padding: 12px 8px; text-align: center; font-weight: bold;">
                                    ENTRIES</th>
                                <th
                                    style="border: 1px solid #d1d5db; padding: 12px 8px; text-align: center; font-weight: bold;">
                                    HEATS</th>
                                <th
                                    style="border: 1px solid #d1d5db; padding: 12px 8px; text-align: center; font-weight: bold;">
                                    START AT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr style="{{ $loop->index % 2 == 0 ? '' : 'background-color: #f9fafb;' }}">
                                    <td
                                        style="border: 1px solid #d1d5db; padding: 8px; text-align: center; font-weight: 600;">
                                        {{ $event->code ?? $event->id }}</td>
                                    <td style="border: 1px solid #d1d5db; padding: 8px; text-align: left;">
                                        {{ $event->name }}
                                    </td>
                                    <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                        {{ $event->registrations_count ?? 0 }}</td>
                                    <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                        {{ $event->heat ?? '-' }}</td>
                                    <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                        {{ $event->start_time ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        style="border: 1px solid #d1d5db; padding: 16px 8px; text-align: center; color: #6b7280;">
                                        No events scheduled.</td>
                                </tr>
                            @endforelse

                            <!-- Total Row -->
                            <tr style="background-color: #f3f4f6; font-weight: 600;">
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: left;" colspan="2">
                                    TOTAL ENTRIES / HEATS :
                                </td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                    {{ $events->sum('registrations_count') }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                    {{ $events->sum('heat') }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; text-align: center;">
                                    -</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer -->
                <div class="mt-4 pt-4 border-t border-gray-300 text-center text-xs text-gray-600">
                    <p>Printed on {{ strtoupper(\Carbon\Carbon::now()->format('l, d F Y H:i')) }}</p>
                    <p class="mt-1 font-semibold">Official Partners</p>
                    <div class="flex justify-center items-center gap-3 mt-2 flex-wrap text-[9px] text-gray-400">
                        <span>SPECTRA</span>
                        <span>•</span>
                        <span>BankJatim</span>
                        <span>•</span>
                        <span>EDEN</span>
                        <span>•</span>
                        <span>Universal</span>
                        <span>•</span>
                        <span>JAB Friendation</span>
                        <span>•</span>
                        <span>Bukalapak</span>
                        <span>•</span>
                        <span>Gojek</span>
                        <span>•</span>
                        <span>ISG</span>
                        <span>•</span>
                        <span>ALGE</span>
                    </div>
                    <p class="mt-2 text-[9px]">Page 1/1</p>
                </div>
            </div>
        </div>
</body>

</html>