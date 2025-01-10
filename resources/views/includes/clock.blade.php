<script>
    function updateClock() {
        const now = new Date();

        const days = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU"];
        const months = [
            "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI",
            "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"
        ];

        const day = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, "0");
        const minutes = String(now.getMinutes()).padStart(2, "0");
        const seconds = String(now.getSeconds()).padStart(2, "0");

        const formattedDate = `${day}, ${date} ${month} ${year}`;
        const formattedTime = `${hours} : ${minutes} : ${seconds}`;

        document.getElementById("current-date").textContent = formattedDate;
        document.getElementById("current-time").textContent = `${formattedTime} WIB`;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>
