import { useState } from "react";

export default function Inventory() {
  const [items, setItems] = useState([
    { name: "Rice", stock: 50, min: 10, unit: "kg" },
    { name: "Oil", stock: 5, min: 10, unit: "L" },
    { name: "Sugar", stock: 20, min: 8, unit: "kg" }
  ]);

  const [newItem, setNewItem] = useState({
    name: "",
    stock: "",
    min: "",
    unit: ""
  });

  const addItem = () => {
    if (!newItem.name || !newItem.stock) return;

    setItems([...items, newItem]);

    setNewItem({
      name: "",
      stock: "",
      min: "",
      unit: ""
    });
  };

  const getBadge = (item) => {
    if (Number(item.stock) <= Number(item.min)) {
      return "bg-danger";
    }
    return "bg-success";
  };

  const getStatus = (item) => {
    if (Number(item.stock) <= Number(item.min)) {
      return "LOW STOCK";
    }
    return "IN STOCK";
  };

  return (
    <div className="container-fluid p-4">

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h3>📦 Inventory Management</h3>
        <button className="btn btn-dark">
          + Add Item
        </button>
      </div>

      {/* FORM */}
      <div className="card shadow p-3 mb-4">
        <div className="row g-2">

          <div className="col-md-3">
            <input
              className="form-control"
              placeholder="Item Name"
              value={newItem.name}
              onChange={(e) =>
                setNewItem({ ...newItem, name: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <input
              className="form-control"
              type="number"
              placeholder="Stock"
              value={newItem.stock}
              onChange={(e) =>
                setNewItem({ ...newItem, stock: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <input
              className="form-control"
              type="number"
              placeholder="Min Stock"
              value={newItem.min}
              onChange={(e) =>
                setNewItem({ ...newItem, min: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <input
              className="form-control"
              placeholder="Unit (kg/L)"
              value={newItem.unit}
              onChange={(e) =>
                setNewItem({ ...newItem, unit: e.target.value })
              }
            />
          </div>

          <div className="col-md-3">
            <button
              className="btn btn-success w-100"
              onClick={addItem}
            >
              Add Item
            </button>
          </div>

        </div>
      </div>

      {/* TABLE */}
      <div className="card shadow">

        <div className="card-header bg-danger text-white">
          Inventory Stock List
        </div>

        <table className="table mb-0">
          <thead>
            <tr>
              <th>Item</th>
              <th>Stock</th>
              <th>Min Stock</th>
              <th>Unit</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            {items.map((item, index) => (
              <tr key={index}>

                <td>{item.name}</td>
                <td>{item.stock}</td>
                <td>{item.min}</td>
                <td>{item.unit}</td>

                <td>
                  <span className={`badge ${getBadge(item)}`}>
                    {getStatus(item)}
                  </span>
                </td>

              </tr>
            ))}
          </tbody>
        </table>

      </div>

      {/* LOW STOCK ALERT PANEL */}
      <div className="card shadow mt-4 p-3">

        <h5>⚠ Low Stock Alerts</h5>

        {items.filter(i => Number(i.stock) <= Number(i.min)).length === 0 ? (
          <p className="text-success">All stock levels are healthy ✅</p>
        ) : (
          items
            .filter(i => Number(i.stock) <= Number(i.min))
            .map((item, i) => (
              <div key={i} className="alert alert-danger mb-2">
                ⚠ {item.name} is low (Only {item.stock} {item.unit} left)
              </div>
            ))
        )}

      </div>

    </div>
  );
}