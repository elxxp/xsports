// alert
notifHide()
function notifHide(){
    setTimeout(function() {
        document.getElementById('alertNontification').classList.replace('alertIn', 'alertOut');
    }, 3000);
}


// default php
if (document.getElementById("jam_mulai").value !== "null") {
    console.log("Jam mulai dipilih: " + document.getElementById("jam_mulai").value)
    updateJamSelesai()
} else {
    console.log("Belum pilih jam mulai")
}

// jam selesai sebelum disable
function updateJamSelesai() {
    const mulai = document.getElementById("jam_mulai").value;
    const selesaiSelect = document.getElementById("jam_selesai");
    selesaiSelect.innerHTML = ""; // clear 
    selesaiSelect.disabled = true;

    if (mulai !== "null") {
        let parts = mulai.split(":");
        let startHour = parseInt(parts[0]);

        let defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.text = "Jam selesai";
        defaultOption.disabled = false;
        defaultOption.selected = true;
        selesaiSelect.appendChild(defaultOption);

        for (let h = 7; h <= 21; h++) {
            let jam = (h < 10 ? "0" : "") + h + ":00";
            let option = document.createElement("option");
            option.value = jam;
            option.text = jam;

            if (h <= startHour) {
                option.disabled = true;
            }

            selesaiSelect.appendChild(option);
        }

        selesaiSelect.disabled = false;
    } else {
        let defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.text = "Jam selesai";
        defaultOption.disabled = false;
        defaultOption.selected = true;
        selesaiSelect.appendChild(defaultOption);
        selesaiSelect.disabled = true;
    }
}

// update biaya tarif
function orderGrand(){
    const container = document.querySelector("#detail")
    const sport = document.getElementById("sport").value
    const venue = document.getElementById("venue").value
    const tanggal = document.getElementById("datepicker-format").value
    const jamMulai = document.getElementById("jam_mulai").value
    const jamSelesai = document.getElementById("jam_selesai").value

    document.querySelector("#alertCekJadwal").innerHTML = ""
    console.log('order-')

    if(sport != "null" && venue != "null" && tanggal != "" && jamMulai != "null" && jamSelesai != ""){
        fetch('../core/fetch/getTarif.php?id_venue=' + venue)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    const tarif = item.tarif.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    let intTarif = tarif.replace(/\D/g, '');
                    let intJamMulai = jamMulai.substring(0, 2);
                    let intJamSelesai = jamSelesai.substring(0, 2);
                    let strVenue = item.venue;
                    let selisih = intJamSelesai - intJamMulai;
                    let total = intTarif * selisih;
                    let totalFormat = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    container.innerHTML = '<p class="text-sm tracking-tight text-gray-900 dark:text-white"><span class="text-xl text-blue-600 font-bold">Rp. ' + totalFormat + '</span> - Lap. ' + strVenue + ' (' + selisih + ' Jam)</p>'
                });
                venueSelect.disabled = false;
            })
            .catch(error => {
                console.error('Gagal ambil data lapangan:', error);
            });
        

    } else {
        container.innerHTML = '<p class="text-sm tracking-tight text-gray-900 dark:text-white"><span class="text-xl text-blue-600 font-bold">Lengkapi data formulir!</span></p>'
    }
}

// form validation 
function VA(){
    buttonLoading('buttonForm', 'Buat pesanan')
    alert = document.getElementById('alertContainer')

    setTimeout(function() {
        const sport = document.getElementById("sport").value
        const venue = document.getElementById("venue").value
        const tanggal = document.getElementById("datepicker-format").value
        const jamMulai = document.getElementById("jam_mulai").value
        const jamSelesai = document.getElementById("jam_selesai").value
        const nama  = document.getElementById("getNama").value
        const telp = document.getElementById("getTelp").value
        const email = document.getElementById("getEmail").value
        const bukti = document.getElementById('file_input').value
        const snk = document.getElementById("snk").checked
        console.log(venue)
    
        if(sport != "null"){
            if(venue != "null"){
                if(tanggal != ""){
                    if(jamMulai != "null"){
                        if(jamSelesai != ""){
                            if(nama != ""){
                                if(telp != ""){
                                    if(email != ""){
                                        if(bukti != ""){
                                            if(snk == true){
                                                let requestJadwal = tanggal +  ' ' + jamMulai
                                                if(new Date(requestJadwal) > new Date()){
                                                           
                                                    let xhr = new XMLHttpRequest();
                                                    xhr.open("POST", "../core/fetch/cekJadwalStatus", true);
                                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState === 4 && xhr.status === 200) {

                                                                let isAvailable = xhr.responseText;
                                                                console.log(isAvailable)
                                                                if(isAvailable == 1){
                                                                    submitForm('s', 'buttonForm', 'Buat pesanan')
                                                                    // alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                                                                    // <i class="fa-solid fa-circle-check mr-2"></i>ok
                                                                    // </div>`
                                                                    // notifHide()
                                                                    // buttonUnloading('buttonForm', 'Buat pesanan')

                                                                }

                                                        } 
                                                    };
                                                    xhr.send("tanggal=" + encodeURIComponent(tanggal) + "&jam_mulai=" + encodeURIComponent(jamMulai) + "&jam_selesai=" + encodeURIComponent(jamSelesai) + "&olahraga=" + encodeURIComponent(sport) + "&venue=" + encodeURIComponent(venue));

                                                } else {
                                                    alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                                    <i class="fa-solid fa-circle-exclamation mr-2"></i>Pastikan jadwal penyewaan bukan waktu lampau
                                                    </div>`
                                                    notifHide()
                                                    buttonUnloading('buttonForm', 'Buat pesanan')
                                                }
                                            } else {
                                                alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-amber-600 bg-amber-400/20 dark:bg-amber-700/20 border border-amber-300  dark:text-amber-600 dark:border-amber-500 rounded-lg px-3.5 py-2 mb-1">
                                                <i class="fa-solid fa-circle-exclamation mr-2"></i>Setujui syarat dan ketentuan yang berlaku
                                                </div>`
                                                notifHide()
                                                buttonUnloading('buttonForm', 'Buat pesanan')
                                            }
                                        } else {
                                            alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                            <i class="fa-solid fa-circle-exclamation mr-2"></i>Upload bukti pembayaran terlebih dahulu
                                            </div>`
                                            notifHide()
                                            buttonUnloading('buttonForm', 'Buat pesanan')
                                        }
                                    } else {
                                        alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                        <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan email terlebih dahulu
                                        </div>`
                                        notifHide()
                                        buttonUnloading('buttonForm', 'Buat pesanan')
                                    }
                                } else {
                                    alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                    <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan nomor telepon terlebih dahulu
                                    </div>`
                                    notifHide()
                                    buttonUnloading('buttonForm', 'Buat pesanan')
                                }
                            } else {
                                alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan nama lengkap terlebih dahulu
                                </div>`
                                notifHide()
                                buttonUnloading('buttonForm', 'Buat pesanan')
                            }
                        } else {
                            alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i>Tentukan jam selesai sewa terlebih dahulu
                            </div>`
                            notifHide()
                            buttonUnloading('buttonForm', 'Buat pesanan')
                        }
                    } else {
                        alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>Tentukan jam mulai sewa terlebih dahulu
                        </div>`
                        notifHide()
                        buttonUnloading('buttonForm', 'Buat pesanan')
                    }
                } else {
                    alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>Tentukan tanggal sewa terlebih dahulu
                    </div>`
                    notifHide()
                    buttonUnloading('buttonForm', 'Buat pesanan')
                }
            } else {
                alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Pilih lapangan terlebih dahulu
                </div>`
                notifHide()
                buttonUnloading('buttonForm', 'Buat pesanan')
            }
        } else {
            alert.innerHTML = `<div id="alertNontification" class="alertIn fixed z-99 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>Pilih jenis olahraga terlebih dahulu
            </div>`
            notifHide()
            buttonUnloading('buttonForm', 'Buat pesanan')
        }
    }, 1000);
}


// fetch cek jadwal
function cekJadwal() {
    const alertContainer = document.querySelector("#alertCekJadwal");

    buttonLoading("buttonCekJadwal", "Cek ketersediaan jadwal");
    alertContainer.innerHTML = ""
    
    let tanggal = document.getElementById("datepicker-format").value;
    let jamMulai = document.getElementById("jam_mulai").value;
    let jamSelesai = document.getElementById("jam_selesai").value;
    let olahraga = document.getElementById("sport").value;
    let venue = document.getElementById("venue").value;
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../core/fetch/cekJadwal", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            setTimeout(function() {
                alertContainer.innerHTML = xhr.responseText;
                buttonUnloading("buttonCekJadwal", "Cek ketersediaan jadwal");
            }, 1000);
        }
    };
    xhr.send("tanggal=" + encodeURIComponent(tanggal) + "&jam_mulai=" + encodeURIComponent(jamMulai) + "&jam_selesai=" + encodeURIComponent(jamSelesai) + "&olahraga=" + encodeURIComponent(olahraga) + "&venue=" + encodeURIComponent(venue));

};


// payment modal switcher
function paymentSwitch(payment){
    title = document.getElementById("paymentSwitch")
    rekening = document.getElementById("paymentSwitchRek")

    card = document.getElementById('cardPesanan').classList.remove('hidden')

    if(payment == 'bni'){
        title.innerHTML = "Bank BNI"
        rekening.innerHTML = "05468450112540 XSPORTS BNI"
    } else if (payment == "mandiri") {        
        title.innerHTML = "Bank Mandiri"
        rekening.innerHTML = "0254887574058 XSPORTS LIVIN"
    } else if (payment == "bri") {
        title.innerHTML = "Bank BRI"
        rekening.innerHTML = "5876985402354802 XSPORTS BRImo"        
    } else if (payment == "bca") {
        title.innerHTML = "Bank BCA"
        rekening.innerHTML = "002459322470651 XSPORTS ID"        
    }
}


// functions
function submitForm(formID, buttonID, content){
    buttonLoading(buttonID, content)

    setTimeout(function() {
        document.getElementById(formID).submit()
    }, 500);
}
function buttonLoading(buttonID, content) {
    document.getElementById(buttonID).innerHTML = "<i class='fa-solid fa-loader fa-spin fa-spin-reverse mr-2'></i>" + content
    document.getElementById(buttonID).disabled = true
    document.getElementById(buttonID).classList.remove("cursor-pointer")
}
function buttonUnloading(buttonID, content) {
    document.getElementById(buttonID).innerHTML = content
    document.getElementById(buttonID).disabled = false
    document.getElementById(buttonID).classList.add("cursor-pointer")
}
function showPassword(toggleID, inputID){
    let input = document.getElementById(inputID);
    let button = document.getElementById(toggleID);

    if (input.type === "password") {
        input.type = "text";
        button.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
    } else {
        input.type = "password";
        button.innerHTML = "<i class='fa-solid fa-eye'></i>";
    }
}



// autofill dri
function getQueryParam(key) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(key);
}

const sportSelect = document.getElementById('sport');
const venueSelect = document.getElementById('venue');


window.addEventListener('DOMContentLoaded', () => {
    const selectedSport = getQueryParam('autofill_sport');
    const selectedVenue = getQueryParam('autofill_venue');

    if (selectedSport) {
        sportSelect.value = selectedSport;
        fetchLapangan(selectedSport, selectedVenue);
    } else {
        venueSelect.disabled = true;
    }
});

sportSelect.addEventListener('change', () => {
    const sport = sportSelect.value;
    venueSelect.innerHTML = '<option value="null">Pilih lapangan</option>';

    if (sport === 'null') {
        venueSelect.disabled = true;
        return;
    }

    fetchLapangan(sport);
});

function fetchLapangan(sport, selectedVenue = null) {
    fetch('../core/fetch/getVenues.php?sport=' + sport)
        .then(response => response.json())
        .then(data => {
            venueSelect.innerHTML = '<option value="null">Pilih lapangan</option>';
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id_venue;
                option.textContent = item.venue;

                if (selectedVenue && selectedVenue == item.id_venue) {
                    option.selected = true;
                    document.getElementById('tarifCard').innerHTML = `
                        <div class="block w-full p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <p><span class="text-gray-700 text-sm dark:text-gray-300">Tarif lapangan</span> <span class="text-emerald-600 text-md font-bold dark:text-emerald-500">Rp. <span id="tarif"> <i class='fa-solid fa-loader fa-spin fa-spin-reverse mr-2'></i> </span></span> <span class="text-gray-700 text-sm dark:text-gray-300">/ jam</span></p>
                        </div>
                    `;
                    setTimeout(() => {
                        getTarif();
                    }, 1800);
                }
                
                venueSelect.appendChild(option);
            });
            venueSelect.disabled = false;
        })
        .catch(error => {
            console.error('Gagal ambil data lapangan:', error);
        });
}

venueSelect.addEventListener('change', () => {
    getTarif()
})

function getTarif(){
    const venue = document.getElementById('venue').value;
    console.log(venue + ' -tarif')

    if (venue === 'null') {
        document.getElementById('tarifCard').innerHTML = ``;
        return;
    }

    fetch('../core/fetch/getTarif.php?id_venue=' + venue)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                
                const tarif = item.tarif.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                document.getElementById('tarifCard').innerHTML = `
                    <div class="block w-full p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <p><span class="text-gray-700 text-sm dark:text-gray-300">Tarif lapangan</span> <span class="text-emerald-600 text-md font-bold dark:text-emerald-500">Rp. <span id="tarif">`+tarif+`</span></span> <span class="text-gray-700 text-sm dark:text-gray-300">/ jam</span></p>
                    </div>
                `;
            });
            venueSelect.disabled = false;
        })
        .catch(error => {
            console.error('Gagal ambil data lapangan:', error);
        });
}

