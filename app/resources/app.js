import "./sass/main.scss";

// Delete and Update logic
if (document.querySelector(".data-row")) {
    //Dom manipulation helper functions
    const addTextError = (targetElement, text) => {
        const domElem = document.querySelector(targetElement);
        domElem.textContent = text;
    };

    // Validation  helper functions
    const validateDate = (day) => {
        const numbers = /^[-+]?[0-9]+$/;
        if (day.length === 0) {
            return "Das Datum darf nicht leer sein.";
        }

        if (!day.match(numbers)) {
            return "Das Datum muss eine Zahl sein.";
        }

        if (Number(day) <= 0 || Number(day) > 31) {
            return "Das Datum muss zwischen 1 und 31 liegen.";
        }
    };

    const validateMonth = (month) => {
        const numbers = /^[-+]?[0-9]+$/;
        if (month.length === 0) {
            return "Die Monatseingabe darf nicht leer sein.";
        }

        if (!month.match(numbers)) {
            return "Das Monatseingabe muss eine Zahl sein.";
        }

        if (Number(month) <= 0 || Number(month) > 12) {
            return "Die Monatseingabe muss zwischen 1 und 12 liegen.";
        }
    };

    // Generic fetch function
    const fetchHandler = async (actionUrl, options) => {
        let data = null;
        let error = null;
        const fullUrl = `${window.location.href}${actionUrl}`;

        try {
            const res = await fetch(fullUrl, options);
            if (res.status >= 200 && res.status < 300) {
                const responseData = await res.json();
                data = responseData;
            }
        } catch (err) {
            console.log(err);
            error = err;
        }

        return { data, error };
    };

    const handleClick = (e) => {
        // Find out the table row
        const trElem = e.currentTarget.closest("tr");
        // Find out the id of the row
        const id = trElem.dataset.rowId;
        // Find out what action we have  Update or Delete
        const action = e.currentTarget.textContent;
        const descriptionElem = trElem.querySelector(".description");

        // We update
        if (action === "bearbeiten") {
            const response = confirm(
                `Sind Sie sicher, dass Sie diese ${descriptionElem.value} aktualisieren möchten ?`
            );
            if (response) {
                {
                    // Select the elements for update
                    const dayElem = trElem.querySelector(".day");
                    const monthElem = trElem.querySelector(".month");

                    // Validate day input
                    const dayErrorMessage = validateDate(dayElem.value.trim());

                    if (dayErrorMessage != undefined) {
                        const dayErrorElem = document.querySelector(".day-error");
                        addTextError(".day-error", dayErrorMessage);
                        dayElem.classList.add("input-error");
                    } else {
                        addTextError(".day-error", "");
                        dayElem.classList.remove("input-error");
                    }

                    //validate month input
                    const monthErrorMessage = validateMonth(monthElem.value.trim());
                    if (monthErrorMessage != undefined) {
                        const monthErrorElem = document.querySelector(".month-error");
                        addTextError(".month-error", monthErrorMessage);
                        monthElem.classList.add("input-error");
                    } else {
                        addTextError(".month-error", "");
                        monthElem.classList.remove("input-error");
                    }

                    // Validate   description
                    if (descriptionElem.value.trim().length === 0) {
                        const descriptionErrorElem =
                            document.querySelector(".description-error");
                        addTextError(
                            ".description-error",
                            "Die Bezeichnung darf nicht leer sein."
                        );
                        descriptionElem.classList.add("input-error");
                    } else {
                        addTextError(".description-error", "");
                        descriptionElem.classList.remove("input-error");
                    }

                    const updateSelectElem = trElem.querySelector(".select-update");
                    const selectValue =
                        updateSelectElem.options[updateSelectElem.selectedIndex].value;

                    // Check if we do not have errors to post ajax requests to the server for update
                    if (
                        dayErrorMessage === undefined &&
                        monthErrorMessage === undefined &&
                        descriptionElem.value.trim().length > 1
                    ) {
                        const options = {
                            method: "POST",
                            mode: "same-origin",
                            credentials: "same-origin",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                item_id: id,
                                day: dayElem.value,
                                month: monthElem.value,
                                description: descriptionElem.value,
                                time_reminder: selectValue,
                            }),
                        };
                        // fetchHandler("appointments/update", options);
                        if (fetchHandler("appointments/update", options)) {
                            if (dayElem.value.length <= 1) {
                                dayElem.value = "0" + dayElem.value + ".";
                            } else {
                                dayElem.value = dayElem.value + ".";
                            }

                            if (monthElem.value.length <= 1) {
                                monthElem.value = "0" + monthElem.value + ".";
                            } else {
                                monthElem.value = monthElem.value + ".";
                            }

                            alert("Erfolg aktualisieren");
                        }
                    }
                }
            }
        }
        // We delete
        if (action === "löschen") {
            const response = confirm(
                `Sind Sie sicher, dass Sie diese ${descriptionElem.value} löschen möchten `
            );

            if (response) {
                const options = {
                    method: "POST",
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ item_id: id }),
                };
                const { data, error } = fetchHandler("appointments/delete", options);

                // remove element from dom
                trElem.remove();
            }
        }
    };

    const editElements = document.querySelectorAll(".edit");
    editElements.forEach((el) => {
        el.addEventListener("click", handleClick);
    });

    const removeElements = document.querySelectorAll(".delete");
    removeElements.forEach((el) => {
        el.addEventListener("click", handleClick);
    });

    
}


// Logout logic
if (document.querySelector(".logout-link")) {
    const navbarLogoutElement = document.querySelector(".logout-link");

    navbarLogoutElement.addEventListener("click", (e) => {
        const response = confirm("Sie möchten sich abmelden?");

        if (!response) {
            e.preventDefault();
        }
    });
}
