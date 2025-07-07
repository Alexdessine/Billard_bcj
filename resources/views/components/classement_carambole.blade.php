@props(['discipline'])


<div id="excel-tabs" class="max-w-full overflow-x-auto p-4 bg-white rounded shadow mx-auto"></div>
{{-- <iframe src="data:application/pdf;base64,{{ $base64pdf }}" width="100%" height="800px" style="border: none;"></iframe> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    const fileUrl = "{{ asset('storage/pdf/carambole/excel/Une bande 23 joueurs.xlsx') }}";

    fetch(fileUrl)
        .then(response => response.arrayBuffer())
        .then(arrayBuffer => {
            const data = new Uint8Array(arrayBuffer);
            const workbook = XLSX.read(data, { type: "array" });

            const tabContainer = document.getElementById("excel-tabs");
            const sheetsDivs = [];
            const buttons = [];

            workbook.SheetNames.forEach((sheetName, index) => {
                const sheet = workbook.Sheets[sheetName];

                const tempDiv = document.createElement("div");
                tempDiv.innerHTML = XLSX.utils.sheet_to_html(sheet);

                const table = tempDiv.querySelector("table");
                table.className = "min-w-full table-auto border border-gray-300 text-sm";
                table.querySelectorAll("td, th").forEach(cell => {
                    cell.className = "border border-gray-300 px-2 py-1";
                });

                const sheetDiv = document.createElement("div");
                sheetDiv.id = "sheet-" + index;
                sheetDiv.style.display = index === 0 ? "block" : "none";
                sheetDiv.appendChild(table);

                tabContainer.appendChild(sheetDiv);
                sheetsDivs.push(sheetDiv);
            });

            const tabFooters = document.createElement("div");
            tabFooters.className = "flex flex-wrap justify-center gap-2 mt-4";

            workbook.SheetNames.forEach((sheetName, index) => {
                const button = document.createElement("button");
                button.innerText = sheetName;
                button.className = `px-4 py-1 rounded transition ${
                    index === 0
                        ? 'bg-blue-700 text-white'
                        : 'bg-blue-100 text-blue-700 hover:bg-blue-200'
                }`;
                button.onclick = () => {
                    sheetsDivs.forEach((div, i) => {
                        div.style.display = i === index ? "block" : "none";
                    });

                    buttons.forEach((btn, i) => {
                        btn.className = `px-4 py-1 rounded transition ${
                            i === index
                                ? 'bg-blue-700 text-white'
                                : 'bg-blue-100 text-blue-700 hover:bg-blue-200'
                        }`;
                    });
                };
                buttons.push(button);
                tabFooters.appendChild(button);
            });

            tabContainer.appendChild(tabFooters);
        });
</script> --}}




