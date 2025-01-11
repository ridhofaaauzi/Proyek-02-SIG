<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('detailModal');

        const modalDistrictName = document.getElementById('modalDistrictName');
        const modalDistrictDataYear = document.getElementById('modalDistrictDataYear');
        const modalDistrictLatitude = document.getElementById('modalDistrictLatitude');
        const modalDistrictLongitude = document.getElementById('modalDistrictLongitude');
        const modalBirthYear = document.getElementById('modalBirthYear');
        const modalPopulation = document.getElementById('modalPopulation');
        const modalArea = document.getElementById('modalArea');
        const modalBirthRate = document.getElementById('modalBirthRate');

        openModalButton.addEventListener('click', () => {
            modalDistrictName.textContent = "{{ $birth_rate->district->name }}";
            modalDistrictDataYear.textContent = "{{ $district_data->year }}";
            modalDistrictLatitude.textContent = "{{ $birth_rate->district->latitude }}°";
            modalDistrictLongitude.textContent = "{{ $birth_rate->district->longitude }}°";
            modalBirthYear.textContent = "{{ $birth_rate->birthYear->year }}";
            modalPopulation.textContent = "{{ $district_data->population }}";
            modalArea.textContent = "{{ $district_data->area }} Km²";
            modalBirthRate.textContent = "{{ $birth_rate->total }}";
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => modal.classList.add('hidden'));
        closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
