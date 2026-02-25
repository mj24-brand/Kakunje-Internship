import React from "react";
function Product({name,price}){
    return(
        <div>
            <h2>Product Name: {name}</h2>
            <h2>Price: {price}</h2>
            <h2>Brand: 
                {price>30000?"Premium Product":"Budget Product"}
            </h2>
        </div>
    )
}
export default Product;