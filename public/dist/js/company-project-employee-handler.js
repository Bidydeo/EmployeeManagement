document.addEventListener("DOMContentLoaded", function () {
    const companySelect = document.getElementById("company_id");
    const projectSelect = document.getElementById("project_id");
    const employeeSelect = document.getElementById("employees");

    const initialCompany = window.initialCompanyId;
    const initialProject = window.initialProjectId;
    const initialEmployees = window.initialEmployeeIds || [];

    window.selectedCompany = initialCompany;
    window.selectedProject = initialProject;

    function toggleEmployeeVisibility(show) {
        employeeSelect.style.display = show ? "block" : "none";
    }

    async function loadProjects(companyId) {
        projectSelect.innerHTML =
            '<option value="">Selectează proiect</option>';

        const res = await fetch(`/api/companies/${companyId}/projects`);
        const data = await res.json();

        for (const [id, name] of Object.entries(data)) {
            const option = document.createElement("option");
            option.value = id;
            option.textContent = name;

            if (parseInt(id) === parseInt(window.selectedProject)) {
                option.selected = true;
            }

            projectSelect.appendChild(option);
        }
    }

    async function loadEmployees(companyId) {
        employeeSelect.innerHTML = "";
        const res = await fetch(`/api/companies/${companyId}/employees`);
        const data = await res.json();

        for (const [id, name] of Object.entries(data)) {
            const option = document.createElement("option");
            option.value = id;
            option.textContent = name;

            if (
                parseInt(companyId) === parseInt(initialCompany) &&
                parseInt(projectSelect.value) === parseInt(initialProject) &&
                initialEmployees.includes(parseInt(id))
            ) {
                option.selected = true;
            }

            employeeSelect.appendChild(option);
        }
    }

    async function handleCompanyChange(companyId) {
        if (!companyId) {
            toggleEmployeeVisibility(false);
            projectSelect.innerHTML =
                '<option value="">Selectează proiect</option>';
            employeeSelect.innerHTML = "";
            return;
        }

        toggleEmployeeVisibility(true);
        await loadProjects(companyId);
        await loadEmployees(companyId);
    }

    if (companySelect) {
        if (initialCompany) {
            handleCompanyChange(initialCompany);
        }

        companySelect.addEventListener("change", function () {
            window.selectedCompany = this.value;
            window.selectedProject = null;
            window.selectedEmployees = [];
            handleCompanyChange(this.value);
        });

        projectSelect.addEventListener("change", function () {
            window.selectedProject = this.value;
            loadEmployees(companySelect.value);
        });
    }
});
