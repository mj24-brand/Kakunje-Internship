import { useState } from "react";

export default function PurchaseManagement() {
  const [showForm, setShowForm] = useState(false);

  // 📦 DUMMY PURCHASE DATA
  const [purchases, setPurchases] = useState([
    {
      id: 1,
      supplier: "Fresh Farms Ltd",
      item: "Rice",
      qty: 50,
      rate: 60,
      total: 3000,
      status: "Ordered"
    },
    {
      id: 2,
      supplier: "Metro Suppliers",
      item: "Oil",
      qty: 20,
      rate: 150,
      total: 3000,
      status: "Received"
    },
    {
      id: 3,
      supplier: "Green Agro",
      item: "Wheat",
      qty: 100,
      rate: 40,
      total: 4000,
      status: "Pending"
    }
  ]);

  // 📦 DUMMY INVENTORY
  const [inventory, setInventory] = useState([
    { item: "Oil", stock: 20 },
    { item: "Sugar", stock: 10 }
  ]);

  const [newPurchase, setNewPurchase] = useState({
    supplier: "",
    item: "",
    qty: 1,
    rate: 0,
    status: "Ordered"
  });

  // ➕ ADD PURCHASE
  const addPurchase = () => {
    if (!newPurchase.supplier || !newPurchase.item) return;

    const total = Number(newPurchase.qty) * Number(newPurchase.rate);

    setPurchases([
      { ...newPurchase, total, id: Date.now() },
      ...purchases
    ]);

    setShowForm(false);

    setNewPurchase({
      supplier: "",
      item: "",
      qty: 1,
      rate: 0,
      status: "Ordered"
    });
  };

  // 🔁 STATUS UPDATE + INVENTORY LOGIC
  const updateStatus = (id, status, item, qty) => {
    setPurchases(prev =>
      prev.map(p => {
        if (p.id === id) {

          // 👉 WHEN RECEIVED → ADD TO INVENTORY
          if (status === "Received" && p.status !== "Received") {
            setInventory(prevInv => {
              const exists = prevInv.find(i => i.item === item);

              if (exists) {
                return prevInv.map(i =>
                  i.item === item
                    ? { ...i, stock: i.stock + Number(qty) }
                    : i
                );
              }

              return [...prevInv, { item, stock: Number(qty) }];
            });
          }

          return { ...p, status };
        }
        return p;
      })
    );
  };

  // 📊 STATS
  const totalOrdered = purchases.length;
  const totalReceived = purchases.filter(p => p.status === "Received").length;
  const totalPending = purchases.filter(p => p.status === "Pending").length;

  const getBadge = (status) => {
    switch (status) {
      case "Ordered":
        return "bg-warning text-dark";
      case "Received":
        return "bg-success";
      case "Pending":
        return "bg-danger";
      default:
        return "bg-secondary";
    }
  };

  return (
    <div className="container-fluid p-4">

      <div className="row">

        {/* LEFT SIDE */}
        <div className="col-md-8">

          {/* HEADER */}
          <div className="d-flex justify-content-between align-items-center mb-3">
            <h3>📦 Purchase Management</h3>

            <button
              className="btn btn-dark"
              onClick={() => setShowForm(!showForm)}
            >
              + New Purchase
            </button>
          </div>

          {/* FORM */}
          {showForm && (
            <div className="card shadow p-3 mb-3">
              <div className="row g-2">

                <div className="col-md-3">
                  <input
                    className="form-control"
                    placeholder="Supplier"
                    value={newPurchase.supplier}
                    onChange={(e) =>
                      setNewPurchase({ ...newPurchase, supplier: e.target.value })
                    }
                  />
                </div>

                <div className="col-md-3">
                  <input
                    className="form-control"
                    placeholder="Item"
                    value={newPurchase.item}
                    onChange={(e) =>
                      setNewPurchase({ ...newPurchase, item: e.target.value })
                    }
                  />
                </div>

                <div className="col-md-2">
                  <input
                    type="number"
                    className="form-control"
                    placeholder="Qty"
                    value={newPurchase.qty}
                    onChange={(e) =>
                      setNewPurchase({ ...newPurchase, qty: e.target.value })
                    }
                  />
                </div>

                <div className="col-md-2">
                  <input
                    type="number"
                    className="form-control"
                    placeholder="Rate"
                    value={newPurchase.rate}
                    onChange={(e) =>
                      setNewPurchase({ ...newPurchase, rate: e.target.value })
                    }
                  />
                </div>

                <div className="col-md-2">
                  <button
                    className="btn btn-success w-100"
                    onClick={addPurchase}
                  >
                    Save
                  </button>
                </div>

              </div>
            </div>
          )}

          {/* TABLE */}
          <div className="card shadow">

            <div className="card-header bg-danger text-white">
              Purchase Orders
            </div>

            <table className="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Supplier</th>
                  <th>Item</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Update</th>
                </tr>
              </thead>

              <tbody>
                {purchases.map(p => (
                  <tr key={p.id}>
                    <td>{p.supplier}</td>
                    <td>{p.item}</td>
                    <td>{p.qty}</td>
                    <td>₹{p.rate}</td>
                    <td className="text-success">₹{p.total}</td>

                    <td>
                      <span className={`badge ${getBadge(p.status)}`}>
                        {p.status}
                      </span>
                    </td>

                    <td>
                      <select
                        className="form-select"
                        value={p.status}
                        onChange={(e) =>
                          updateStatus(
                            p.id,
                            e.target.value,
                            p.item,
                            p.qty
                          )
                        }
                      >
                        <option>Ordered</option>
                        <option>Received</option>
                        <option>Pending</option>
                      </select>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>

          </div>

        </div>

        {/* RIGHT SIDE */}
        <div className="col-md-4">

          {/* STATS CARDS */}
          <div className="card shadow p-3 mb-3">
            <h5>📊 Live Status</h5>
            <hr />
            <p>🛒 Total Orders: {totalOrdered}</p>
            <p>📦 Received: {totalReceived}</p>
            <p>⏳ Pending: {totalPending}</p>
          </div>

          {/* INVENTORY */}
          <div className="card shadow p-3">
            <h5>📦 Inventory Stock</h5>
            <hr />

            {inventory.map((i, idx) => (
              <div
                key={idx}
                className="d-flex justify-content-between border-bottom py-1"
              >
                <span>{i.item}</span>
                <strong>{i.stock}</strong>
              </div>
            ))}

          </div>

        </div>

      </div>
    </div>
  );
}