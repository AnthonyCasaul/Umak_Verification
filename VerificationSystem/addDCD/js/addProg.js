const programs = {
    ccis: ["BACHELOR OF SCIENCE IN COMPUTATIONAL & DATA SCIENCES", "BACHELOR OF SCIENCE IN COMPUTER NETWORK ADMINISTRATION"],
    cthm: ["BACHELOR IN INTERNATIONAL CULINARY MANAGEMENT", "BACHELOR OF SCIENCE IN HOSPITALITY MANAGEMENT"],
    cal: ["BACHELOR OF ARTS IN COMMUNICATION & SERVICE MANAGEMENT", "BACHELOR OF ARTS IN CUSTOMER SERVICE COMMUNICATION"]
  };
  
  // Get the HTML elements
  const departmentSelect = document.getElementById("department");
  const programContainer = document.getElementById("program-container");
  const departmentTitle = document.getElementById("department-title");
  const programList = document.getElementById("program-list");
  const programInput = document.getElementById("program-input");
  
  // Function to display the programs for the selected department
  function displayPrograms() {
    const selectedDepartment = departmentSelect.value;
    departmentTitle.textContent = `${selectedDepartment.toUpperCase()} Programs`;
    programList.innerHTML = "";
    programs[selectedDepartment].forEach((program) => {
      const listItem = document.createElement("li");
      listItem.textContent = program;
      programList.appendChild(listItem);
    });
    programContainer.classList.add("show");
  }
  
  // Function to add a new program to the selected department
  function addProgram() {
    const selectedDepartment = departmentSelect.value;
    const program = programInput.value;
    if (program !== "") {
      programs[selectedDepartment].push(program);
      const listItem = document.createElement("li");
      listItem.textContent = program;
      programList.appendChild(listItem);
      programInput.value = "";
    }
  }