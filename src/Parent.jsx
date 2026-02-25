import React from "react";
import Product from "./Child";
function Parent(){
    return(
        <div>
            <h2>//Parent-Child props rendering//</h2>
            <Product name="Laptop" price={50000}/>
            <Product name="Mobile" price={20000}/>
        </div>
    )
}
export default Parent;
