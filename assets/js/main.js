// alert
setTimeout(function() {
    document.getElementById('alertNontification').classList.replace('alertIn', 'alertOut');
}, 2000);


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
    const tarif = document.getElementById("tarif").innerHTML
    document.querySelector("#alertCekJadwal").innerHTML = ""
    console.log('order-')

    if(sport != "null" && venue != "null" && tanggal != "" && jamMulai != "null" && jamSelesai != ""){

        let intTarif = parseInt(tarif.replace(/\,/g, ''), 10);
        let intJamMulai = jamMulai.substring(0, 2);
        let intJamSelesai = jamSelesai.substring(0, 2);
        let selisih = intJamSelesai - intJamMulai;
        let total = intTarif * selisih;
        let totalFormat = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        container.innerHTML = '<p class="text-sm tracking-tight text-gray-900 dark:text-white"><span class="text-xl text-blue-600 font-bold">Rp. ' + totalFormat + '</span> - Lap. ' + venue + ' (' + selisih + ' Jam)</p>'

    } else {
        container.innerHTML = '<p class="text-sm tracking-tight text-gray-900 dark:text-white"><span class="text-xl text-blue-600 font-bold">Lengkapi data formulir!</span></p>'
    }
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