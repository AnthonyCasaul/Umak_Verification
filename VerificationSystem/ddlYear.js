var currentYear = new Date().getFullYear();

// Create the dropdown options
var dropdown = document.getElementById("yearDropdown");

// Add the preselected option
var preselectedOption = document.createElement("option");
preselectedOption.text = currentYear - 1 + "-" + currentYear;
preselectedOption.value = currentYear - 1 + "-" + currentYear;
preselectedOption.selected = true;
dropdown.add(preselectedOption);

// Add the remaining options
for (var year = 1965; year <= currentYear; year++) {
  var option = document.createElement("option");
  option.text = year + "-" + (year + 1);
  option.value = year + "-" + (year + 1);
  dropdown.add(option);
}
