<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order of Event</title>
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
                pdf.save('Order_of_Event.pdf');
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
            <button onclick="exportToPDF()" class="mb-4 bg-gradient-to-br from-red-600 to-red-900 text-white px-6 py-2.5 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 inline-flex items-center gap-2">
                <i class="fas fa-file-pdf"></i>
                Export to PDF
            </button>
        </div>
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-4">
                <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-xs text-center">
                    LOGO
                </div>
                <div class="flex-1 text-center px-4">
                    <h4 class="text-sm font-semibold leading-tight">Akuatik Bojonegoro Swimming Competition 2 tahun 2025</h4>
                    <h4 class="text-sm font-semibold leading-tight">Kolam Renang Tirta Wana Bojonegoro</h4>
                    <p class="text-xs text-gray-600 mt-1">06 - 06 SEPTEMBER 2025</p>
                </div>
                <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center text-xs text-center">
                    LOGO
                </div>
            </div>

            <!-- Title -->
            <div class="mb-4 text-center">
                <h3 class="text-xl font-bold">ORDER OF EVENT</h3>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse min-w-[800px] text-xs">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-300">
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Evt</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Event Description</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Kind</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">AG</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Min DoB</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Max DoB</th>
                            <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events ?? [] as $index => $event)
                        <tr class="{{ $index % 2 == 0 ? '' : 'bg-gray-50' }} hover:bg-gray-100">
                            <td class="border border-gray-300 px-2 py-2 text-center font-semibold">{{ $event->evt ?? ($index + 101) }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-left">{{ $event->event_description ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-center">{{ $event->kind ?? 'INDIVIDUAL' }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-center">{{ $event->ag ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-center">{{ $event->min_dob ? \Carbon\Carbon::parse($event->min_dob)->format('d/m/Y') : '-' }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-center">{{ $event->max_dob ? \Carbon\Carbon::parse($event->max_dob)->format('d/m/Y') : '-' }}</td>
                            <td class="border border-gray-300 px-2 py-2 text-center">{{ $event->date ? \Carbon\Carbon::parse($event->date)->format('d/m/Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 px-2 py-4 text-center text-gray-500">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100 border-t-2 border-gray-300 font-bold">
                            <td colspan="7" class="border border-gray-300 px-2 py-3 text-center">Total Events: {{ count($events ?? []) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer -->
            <div class="mt-4 pt-4 border-t border-gray-300 text-center text-xs text-gray-600">
                <p>Printed on {{ strtoupper(\Carbon\Carbon::now()->format('l d F Y H:i')) }}</p>
                <p class="mt-1 font-semibold">Official Partners</p>
                <div class="flex justify-center items-center gap-3 mt-2 flex-wrap text-[9px] text-gray-400">
                    <span>BankJatim</span>
                    <span>•</span>
                    <span>EDEN</span>
                    <span>•</span>
                    <span>Universal</span>
                    <span>•</span>
                    <span>BTNET</span>
                    <span>•</span>
                    <span>Samator</span>
                    <span>•</span>
                    <span>Kahf</span>
                    <span>•</span>
                    <span>Universal</span>
                    <span>•</span>
                    <span>RADA BOJONEGORO</span>
                </div>
                <p class="mt-2 text-[9px]">Page 1/1</p>
            </div>
        </div>

        
    </div>
</body>
</html>