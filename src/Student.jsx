import React from "react";

function Student(props){
    return(
        <div>
            <h2>//Props with destructuring//</h2>
        <h2>Student Name: {props.name}</h2>
        <h2>Marks: {props.marks}</h2>
        <h2>Result: 
            {props.marks >40? "Pass":"Fail"}
        </h2>
        </div>
    )
}
export default Student;