import { useState } from "react";

export default function SupplierManagement() {
  const [suppliers, setSuppliers] = useState([
    {
      name: "ABC Traders",
      contact: "9876543210",
      address: "Mangalore",
      items: "Rice, Oil",
      paid: "Pending"
    },
    {
      name: "Fresh Foods Ltd",
      contact: "9123456780",
      address: "Udupi",
      items: "Vegetables, Fruits",
      paid: "Paid"
    }
  ]);

  const [newSupplier, setNewSupplier] = useState({
    name: "",
    contact: "",
    address: "",
    items: "",
    paid: "Pending"
  });

  const addSupplier = () => {
    if (!newSupplier.name || !newSupplier.contact) return;

    setSuppliers([...suppliers, newSupplier]);

    setNewSupplier({
      name: "",
      contact: "",
      address: "",
      items: "",
      paid: "Pending"
    });
  };

  return (
    <div className="container-fluid p-4">

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h3>🚚 Supplier Management</h3>
        <button className="btn btn-dark">
          + Add Supplier
        </button>
      </div>

      {/* FORM */}
      <div className="card shadow p-3 mb-4">
        <div className="row g-2">

          <div className="col-md-3">
            <input
              className="form-control"
              placeholder="Supplier Name"
              value={newSupplier.name}
              onChange={(e) =>
                setNewSupplier({ ...newSupplier, name: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <input
              className="form-control"
              placeholder="Contact"
              value={newSupplier.contact}
              onChange={(e) =>
                setNewSupplier({ ...newSupplier, contact: e.target.value })
              }
            />
          </div>

          <div className="col-md-3">
            <input
              className="form-control"
              placeholder="Address"
              value={newSupplier.address}
              onChange={(e) =>
                setNewSupplier({ ...newSupplier, address: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <input
              className="form-control"
              placeholder="Items Supplied"
              value={newSupplier.items}
              onChange={(e) =>
                setNewSupplier({ ...newSupplier, items: e.target.value })
              }
            />
          </div>

          <div className="col-md-2">
            <button
              className="btn btn-success w-100"
              onClick={addSupplier}
            >
              Add
            </button>
          </div>

        </div>
      </div>

      {/* TABLE */}
      <div className="card shadow">

        <div className="card-header bg-danger text-white">
          Supplier List
        </div>

        <table className="table mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Address</th>
              <th>Items Supplied</th>
              <th>Payment Status</th>
            </tr>
          </thead>

          <tbody>
            {suppliers.map((s, index) => (
              <tr key={index}>

                <td>{s.name}</td>
                <td>{s.contact}</td>
                <td>{s.address}</td>
                <td>{s.items}</td>

                <td>
                  <span
                    className={`badge ${
                      s.paid === "Paid"
                        ? "bg-success"
                        : "bg-warning text-dark"
                    }`}
                  >
                    {s.paid}
                  </span>
                </td>

              </tr>
            ))}
          </tbody>
        </table>

      </div>

      {/* PAYMENT SUMMARY */}
      <div className="card shadow mt-4 p-3">

        <h5>💰 Payment Overview</h5>

        <hr />

        <p>✔ Paid Suppliers: {suppliers.filter(s => s.paid === "Paid").length}</p>
        <p>⏳ Pending Payments: {suppliers.filter(s => s.paid === "Pending").length}</p>

        <hr />

        <h5 className="text-success">
          Total Suppliers: {suppliers.length}
        </h5>

      </div>

    </div>
  );
}