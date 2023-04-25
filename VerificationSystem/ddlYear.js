// Get the current year
const currentYear = new Date().getFullYear();

// Get the dropdown element
const dropdown = document.getElementById("year");

// Loop through years from 1957 to current year
for (let year = 1957; year <= currentYear; year++) {
  // Create a new option element
  const option = document.createElement("option");

  // Set the text and value of the option element
  option.text = `${year}-${year + 1}`;
  option.value = `${year}-${year + 1}`;

  // Append the option element to the dropdown
  dropdown.add(option);
}
