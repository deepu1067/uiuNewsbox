var inputField = document.getElementById("search");
var courses = document.querySelectorAll(".table tr:not(:first-child)");
var modalBody = document.querySelectorAll(".modal-body")[0];

inputField.addEventListener("keydown", (e) => {
    if (e.key == 'Enter') {
        var value = inputField.value;
        var flag = false;
        var courseName = "";
        var pre_code = "";
        var pre_course = "";
        var pre_course1 = "";
        var pre_course2 = "";

        var courseNameTag = document.createElement('p');
        // console.log(modalBody);

        if ((value.toUpperCase().includes("CSE") || value.toUpperCase().includes("ACT") || value.toUpperCase().includes("BDS")
            || value.toUpperCase().includes("MATH") || value.toUpperCase().includes("BIO") || value.toUpperCase().includes("ECO") ||
            value.toUpperCase().includes("EEE") || value.toUpperCase().includes("ENG") || value.toUpperCase().includes("IPE") 
            || value.toUpperCase().includes("PHY") || value.toUpperCase().includes("PSY") || value.toUpperCase().includes("SOC") 
            || value.toUpperCase().includes("TEC") || value.toUpperCase().includes("URC")) && (value.toUpperCase().length >= 7)) {
            modalBody.innerHTML = "";
            courses.forEach(element => {
                if (element.querySelector("td:nth-child(2)").innerText.includes(value.toUpperCase())) {
                    courseName = element.querySelector("td:nth-child(3)").innerText;
                    courseNameTag.innerHTML = "<strong>Course Name: </strong>" + courseName;
                    modalBody.appendChild(courseNameTag);

                    var tagTitle = document.createElement('p');
                    tagTitle.className = 'text-center';
                    tagTitle.innerHTML = '<strong>Prerequisite</strong>';
                    modalBody.appendChild(tagTitle);

                    pre_code = element.querySelector("td:nth-child(5)").innerHTML.split("<")[0];

                    // console.log("Course name: " + courseName);
                    // console.log("Prequisite: " + pre_code);

                    var div = document.createElement('div');

                    if (pre_code != 'None') {
                        if (pre_code.includes(',')) {
                            pre_course1 = pre_code.split(",")[0].trim();
                            pre_course2 = pre_code.split(",")[1].trim();

                            var code1 = document.createElement('p');
                            code1.innerHTML = '<strong>Course Code: </strong>' + pre_code.split(",")[0].trim();
                            var course1Tag = document.createElement('p');
                            course1Tag.innerHTML = '<strong>Course Name: </strong>' + getCourseName(pre_course1);
                            div.appendChild(code1);
                            div.appendChild(course1Tag);



                            var code2 = document.createElement('p');
                            code2.innerHTML = '<strong>Course Code: </strong>' + pre_code.split(",")[1].trim();
                            var course2Tag = document.createElement('p');
                            course2Tag.innerHTML = '<strong>Course Name: </strong>' + getCourseName(pre_course2);
                            div.appendChild(code2);
                            div.appendChild(course2Tag);

                            // console.log("Course1: " + getCourseName(pre_course1));
                            // console.log("Course2: " + getCourseName(pre_course2));
                        }
                        else {
                            pre_course = getCourseName(pre_code);
                            var codeTag = document.createElement('p');
                            codeTag.innerHTML = '<strong>Course Code: </strong>' + pre_code;
                            var tag = document.createElement('p');
                            tag.innerHTML = '<strong>Course Name: </strong>' + pre_course;

                            div.appendChild(codeTag);
                            div.appendChild(tag);

                            // console.log(pre_course);
                        }
                    }
                    else {
                        var codeTag = document.createElement('p');
                        codeTag.innerHTML = '<strong>Course Code: </strong> None';
                        var tag = document.createElement('p');
                        tag.innerHTML = '<strong>Course Name: </strong> None' ;

                        div.appendChild(codeTag);
                        div.appendChild(tag);
                    }

                    modalBody.appendChild(div);
                    flag = true;
                }
            });

            if (!flag)
            modalBody.innerHTML = "<p class='text-center m-0' style='font-size: 1.5rem'>Not Found</p>"
        }
        else {
            modalBody.innerHTML = "<p class='text-center m-0' style='font-size: 1.5rem'>Invalid Input</p>"
        }


        // console.log(getCourseName(value));

    }
})


function getCourseName(course_id) {
    var course_name = "";
    courses.forEach(element => {
        if (element.querySelector("td:nth-child(2)").innerText.includes(course_id.toUpperCase())) {
            course_name = element.querySelector("td:nth-child(3)").innerText;
        }
    });

    return course_name;
}