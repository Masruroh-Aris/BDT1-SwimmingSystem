<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Result - Akuatik Bojonegoro</title>
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
            const exportBtn = document.querySelector('.export-btn-container');
            if (exportBtn) exportBtn.style.display = 'none';

            try {
                // Capture the content as canvas
                const canvas = await html2canvas(contentElement, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff'
                });

                // Create PDF
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                    orientation: 'portrait', // Portrait for long content might be better, or landscape if tables are wide. Let's stick to user previous landscape preference if implied, but Full Result usually vertical. Let's try Portrait for full result list.
                    unit: 'mm',
                    format: 'a4'
                });

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();

                const imgWidth = pdfWidth;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                // If content is longer than one page, we need pagination (basic implementation here)
                // For simplicity in this iteration, we scale to fit or just add image. 
                // Detailed multi-page is complex with html2canvas. 
                // We will just add the image (it might be very long).
                // Actually, if it's too long, it will look small in one page. 
                // But for "Import PDF" usually single page or we rely on auto pagination if using other libs.
                // With html2canvas + addImage, we stretch it.
                // Let's assume content fits reasonable length or split manually.

                // Standard approach for long content:
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pdfHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pdfHeight;
                }

                pdf.save('Full_Result.pdf');
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF. Please try again.');
            } finally {
                // Show export button again
                if (exportBtn) exportBtn.style.display = 'block';
            }
        }
    </script>

    <!-- Export Button -->
    <div class="text-right export-btn-container mb-4">
        <button onclick="exportToPDF()"
            class="bg-gradient-to-br from-red-600 to-red-900 text-white px-6 py-2.5 rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 inline-flex items-center gap-2">
            <i class="fas fa-file-pdf"></i>
            Export Full Result to PDF
        </button>
    </div>

    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-8">

    <!-- Header Section (Dynamic) -->
    <div class="flex justify-between items-center mb-8 border-b pb-6">
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-xs text-center text-gray-500 font-bold overflow-hidden">
             <img src="{{ asset('images/prsi-logo.png') }}" alt="PSRI Logo" class="w-full h-full object-contain p-1">
        </div>
        <div class="flex-1 text-center px-4">
            <h1 class="text-2xl font-bold text-gray-800 leading-tight mb-2">{{ $meet->name }}</h1>
            <h2 class="text-lg font-semibold text-gray-600 mb-1">{{ $meet->venue }}</h2>
            <p class="text-sm font-bold tracking-wider">
                {{ $meet->start_date ? $meet->start_date->format('d M Y') : 'TBA' }} - 
                {{ $meet->end_date ? $meet->end_date->format('d M Y') : 'TBA' }}
            </p>
        </div>
        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center text-xs text-center text-gray-500 font-bold overflow-hidden">
            @if($meet->logo)
                <img src="{{ asset($meet->logo) }}" alt="Meet Logo" class="w-full h-full object-cover">
            @else
                <span>LOGO</span>
            @endif
        </div>
    </div>

    <!-- SECTION 1: RESULTS -->
    <div class="mb-10">
        <div class="mb-4 text-center">
            <h3 class="text-xl font-bold">COMPETITION RESULTS</h3>
        </div>

        <div class="overflow-x-auto">
             @forelse($groupedResults as $eventName => $eventResults)
                <div class="mb-6">
                    <h4 class="text-sm font-bold bg-gray-100 p-2 border border-gray-300 border-b-0">{{ $eventName }}</h4>
                    <table class="w-full border-collapse min-w-[800px] text-xs">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-300">
                                <th class="border border-gray-300 px-2 py-3 text-left font-bold uppercase">Athlete</th>
                                <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Lane</th>
                                <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Time</th>
                                <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Place</th>
                                <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Point</th>
                                <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eventResults as $index => $res)
                                <tr class="{{ $index % 2 == 0 ? '' : 'bg-gray-50' }}">
                                    <td class="border border-gray-300 px-2 py-3 font-semibold">{{ $res->athlete_name }}</td>
                                    <td class="border border-gray-300 px-2 py-3 text-center">{{ $res->lane ?? '-' }}</td>
                                    <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $res->time_result }}</td>
                                    <td class="border border-gray-300 px-2 py-3 text-center font-bold text-gray-800">#{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-2 py-3 text-center">{{ $res->points ?? '-' }}</td>
                                    <td class="border border-gray-300 px-2 py-3 text-center text-xs uppercase font-bold">{{ $res->status ?? 'Done' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @empty
                <div class="text-center p-4 text-gray-500 border border-dashed border-gray-300 rounded">No Competition Results Available</div>
            @endforelse
        </div>
    </div>

    <!-- SECTION 2: BEST SWIMMER -->
    <div class="mb-10 page-break-app"> <!-- Added generic class for potential PDF break logic -->
        <div class="mb-4 text-center">
            <h3 class="text-xl font-bold">BEST SWIMMER PERFORMANCE</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse min-w-[800px] text-xs">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Pos</th>
                        <th class="border border-gray-300 px-2 py-3 text-left font-bold uppercase">Athlete</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Sex</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Group</th>
                        <th class="border border-gray-300 px-2 py-3 text-left font-bold uppercase">Team</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Gold</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Silver</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Bronze</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSwimmers as $index => $swimmer)
                        <tr class="{{ $index % 2 == 0 ? '' : 'bg-gray-50' }}">
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">#{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-2 py-3 font-semibold">{{ $swimmer->athlete_name }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center">{{ $swimmer->sex }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center">{{ $swimmer->ag }}</td>
                            <td class="border border-gray-300 px-2 py-3">{{ $swimmer->team_name }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $swimmer->gold }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $swimmer->silver }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $swimmer->bronze }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold text-gray-800">{{ $swimmer->point }}</td>
                        </tr>
                    @empty
                         <tr><td colspan="9" class="text-center p-4 text-gray-500 border border-gray-300">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SECTION 3: MEDAL TALLY -->
    <div class="mb-4 page-break-app">
        <div class="mb-4 text-center">
            <h3 class="text-xl font-bold">MEDAL TALLY</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse min-w-[800px] text-xs">
                <thead>
                    <tr class="bg-gray-100 border-b-2 border-gray-300">
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Pos</th>
                        <th class="border border-gray-300 px-2 py-3 text-left font-bold uppercase">Team</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Gold</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Silver</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Bronze</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Total</th>
                        <th class="border border-gray-300 px-2 py-3 text-center font-bold uppercase">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medalTally as $index => $tally)
                        <tr class="{{ $index % 2 == 0 ? '' : 'bg-gray-50' }}">
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">#{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-2 py-3 font-semibold">{{ $tally->team_name }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $tally->gold }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $tally->silver }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $tally->bronze }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold text-gray-800">{{ $tally->total_medal }}</td>
                            <td class="border border-gray-300 px-2 py-3 text-center font-bold">{{ $tally->total_point }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center p-4 text-gray-500 border border-gray-300">No data available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

        <!-- Footer (Common) -->
        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-500 mb-2">Generated on {{ \Carbon\Carbon::now()->format('l, d F Y H:i') }}</p>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Official Partners</p>
            <div
                class="flex justify-center items-center gap-4 mt-3 flex-wrap opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <!-- Mock Partners -->
                <span class="text-xs font-bold text-gray-600">BANK JATIM</span>
                <span class="text-gray-300">•</span>
                <span class="text-xs font-bold text-gray-600">EDEN</span>
                <span class="text-gray-300">•</span>
                <span class="text-xs font-bold text-gray-600">SAMATOR</span>
                <span class="text-gray-300">•</span>
                <span class="text-xs font-bold text-gray-600">KAHF</span>
            </div>
            <p class="mt-4 text-[10px] text-gray-400">© 2025 Akuatik Bojonegoro. All Rights Reserved.</p>
        </div>

    </div>
</body>

</html>