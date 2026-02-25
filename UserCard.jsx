import React from "react";
function UserCard({name,age,city}){
    return(
        <div style={{border:"2px solid black", padding:"10px",margin:"10px"}}>
            <h2>Name:{name}</h2>
            <p>Age: {age}</p>
            <p>City: {city}</p>
        </div>
    )

}
export default UserCard;