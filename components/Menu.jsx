import React from "react";
import "../styles/Menu.css";

import burger from "../assets/burger.jpeg";
import pizza from "../assets/pizza.jpeg";
import fries from "../assets/fries.jpeg";
import sandwich from "../assets/sandwich.jpeg";
import donut from "../assets/donuts.jpeg";
import milkshake from "../assets/milkshake.jpeg";

function Menu() {
  return (
    <div className="menu-page">

      <h1 className="menu-title">MJ Cravings Menu</h1>
      <p style={{fontSize:"25px",fontFamily:"italic"}}>"Explore the delicious menu at MJ Cravings! From juicy burgers and cheesy pizzas to crispy fries and sweet treats, we serve fresh and flavorful dishes that satisfy every craving."</p>

      <div className="menu-container">

        <div className="card">
          <img src={burger} alt="Burger"/>
          <h3>Classic Burger</h3>
          <p className="price">price : 120</p>
          <button>ORDER</button>
        </div>

        <div className="card">
          <img src={pizza} alt="Pizza"/>
          <h3>Cheese Pizza</h3>
          <p className="price">price : 250</p>
          <button>ORDER</button>
        </div>

        <div className="card">
          <img src={fries} alt="Fries"/>
          <h3>Crispy Fries</h3>
          <p className="price">price : 90</p>
          <button>ORDER</button>
        </div>

        <div className="card">
          <img src={sandwich} alt="Sandwich"/>
          <h3>Grilled Sandwich</h3>
          <p className="price">price : 150</p>
          <button>ORDER</button>
        </div>

        <div className="card">
          <img src={donut} alt="Donut"/>
          <h3>Chocolate Donut</h3>
          <p className="price">price: 80</p>
          <button>ORDER</button>
        </div>

        <div className="card">
          <img src={milkshake} alt="Milkshake"/>
          <h3>Oreo Milkshake</h3>
          <p className="price">price : 180</p>
          <button>ORDER</button>
        </div>

      </div>
    </div>
  );
}

export default Menu;