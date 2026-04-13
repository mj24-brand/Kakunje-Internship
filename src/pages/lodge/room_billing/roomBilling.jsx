import axios from "axios";
import { useEffect, useState } from "react";

export default function RoomBilling() {
    const [showForm, setShowForm] = useState(false);
    const [editId, setEditId] = useState(null);
    const [editData, setEditData] = useState({});
    const [bills, setBills] = useState([]);
    const [search, setSearch] = useState("");
    const [newBill, setNewBill] = useState({
        room: "",
        roomRent: 0,
        foodCharges: 0,
        laundry: 0,
        extraServices: 0,
        tax: 0,
        status: "Pending"
    });

    useEffect(() => {
        fetchBills();
    }, []);

    const fetchBills = async () => {
        const res = await axios.get("http://localhost:5000/api/roombilling");
        setBills(res.data);
    };

    const calculateTotal = (b) => {
        const subtotal =
            Number(b.roomRent) +
            Number(b.foodCharges) +
            Number(b.laundry) +
            Number(b.extraServices);

        return subtotal + (subtotal * Number(b.tax)) / 100;
    };

    const addBill = async () => {
        await axios.post("http://localhost:5000/api/roombilling", newBill);
        fetchBills();
        setShowForm(false);
        setNewBill({
            room: "",
            roomRent: 0,
            foodCharges: 0,
            laundry: 0,
            extraServices: 0,
            tax: 0,
            status: "Pending"
        });
    };

    const updateStatus = async (id, status) => {
        await axios.put(`http://localhost:5000/api/roombilling/${id}`, { status });
        fetchBills();
    };

    const handleDelete = async (id) => {
        await axios.delete(`http://localhost:5000/api/roombilling/${id}`);
        setBills(bills.filter(b => b._id !== id));
    };
    const saveEdit = async (id) => {
        try {
            await axios.put(
                `http://localhost:5000/api/roombilling/${id}`,
                {
                    room: editData.room,
                    roomRent: Number(editData.roomRent),
                    foodCharges: Number(editData.foodCharges),
                    laundry: Number(editData.laundry),
                    extraServices: Number(editData.extraServices),
                    tax: Number(editData.tax),
                    status: editData.status
                }
            );

            setEditId(null);
            setEditData({});
            fetchBills();

        } catch (err) {
            console.log("EDIT ERROR:", err);
            alert("Error updating bill");
        }
    };
    const printBill = (b) => {
        const subtotal =
            Number(b.roomRent) +
            Number(b.foodCharges) +
            Number(b.laundry) +
            Number(b.extraServices);

        const taxAmount = (subtotal * Number(b.tax)) / 100;
        const total = subtotal + taxAmount;

        const win = window.open("", "", "width=900,height=700");

        win.document.write(`
    <html>
    <head>
        <title>Hotel Invoice</title>

        <style>
            body {
                font-family: 'Arial';
                padding: 30px;
                background: #fff;
            }

            .invoice-box {
                max-width: 800px;
                margin: auto;
                border: 1px solid #eee;
                padding: 20px;
            }

            .header {
                text-align: center;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
            }

            .logo {
                width: 120px;
                margin-bottom: 10px;
            }

            h2 {
                margin: 0;
            }

            .details {
                margin-top: 20px;
            }

            .row {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                border-bottom: 1px dashed #ddd;
            }

            .label {
                font-weight: bold;
            }

            .total {
                margin-top: 20px;
                font-size: 22px;
                font-weight: bold;
                text-align: right;
                color: green;
            }

            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 12px;
                color: #666;
            }

            .stamp {
                margin-top: 20px;
                text-align: right;
                font-weight: bold;
                color: #444;
            }
        </style>
    </head>

    <body>

    <div class="invoice-box">

        <!-- HEADER -->
        <div class="header">
            <img src={logo} alt="Logo" style={{ width: "350px" }} />
            <h2> MANGALORE INTERNATIONAL LODGE</h2>
            <p>Luxury Stay & Comfort</p>
        </div>

        <!-- BILL INFO -->
        <div class="details">

            <div class="row">
                <span class="label">Room Number</span>
                <span>${b.room}</span>
            </div>

            <div class="row">
                <span class="label">Room Rent</span>
                <span>₹${b.roomRent}</span>
            </div>

            <div class="row">
                <span class="label">Food Charges</span>
                <span>₹${b.foodCharges}</span>
            </div>

            <div class="row">
                <span class="label">Laundry</span>
                <span>₹${b.laundry}</span>
            </div>

            <div class="row">
                <span class="label">Extra Services</span>
                <span>₹${b.extraServices}</span>
            </div>

            <div class="row">
                <span class="label">Tax</span>
                <span>${b.tax}%</span>
            </div>

        </div>

        <!-- TOTAL -->
        <div class="total">
            GRAND TOTAL: ₹${total}
        </div>

        <div class="stamp">
            Status: ${b.status}
        </div>

        <!-- FOOTER -->
        <div class="footer">
            Thank you for staying with us ❤️<br/>
            Visit Again | Mangalore International
        </div>

    </div>

    <script>
        window.print();
    </script>

    </body>
    </html>
    `);

        win.document.close();
    };

    return (
        <div className="container-fluid p-4">

            {/* HEADER */}
            <div className="d-flex justify-content-between align-items-center mb-3">
                <h3>💳 Room Billing Console</h3>
                <button className="btn btn-dark" onClick={() => setShowForm(!showForm)}>
                    + New Bill
                </button>
            </div>

            {/* FORM CARD */}
            {showForm && (
                <div className="card shadow p-3 mb-4">
                    <div className="row g-2">

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Room"
                                value={newBill.room}
                                onChange={(e) => setNewBill({ ...newBill, room: e.target.value })}
                            />
                        </div>

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Room Rent"
                                type="number"
                                onChange={(e) => setNewBill({ ...newBill, roomRent: e.target.value })}
                            />
                        </div>

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Food"
                                type="number"
                                onChange={(e) => setNewBill({ ...newBill, foodCharges: e.target.value })}
                            />
                        </div>

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Laundry"
                                type="number"
                                onChange={(e) => setNewBill({ ...newBill, laundry: e.target.value })}
                            />
                        </div>

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Extra"
                                type="number"
                                onChange={(e) => setNewBill({ ...newBill, extraServices: e.target.value })}
                            />
                        </div>

                        <div className="col-md-2">
                            <input className="form-control" placeholder="Tax %"
                                type="number"
                                onChange={(e) => setNewBill({ ...newBill, tax: e.target.value })}
                            />
                        </div>

                        <div className="col-md-12">
                            <button className="btn btn-success w-100 mt-2" onClick={addBill}>
                                Generate Bill
                            </button>
                        </div>


                    </div>
                </div>
            )}

            {/* SEARCH */}
            <input
                className="form-control mb-3"
                placeholder="Search room..."
                onChange={(e) => setSearch(e.target.value)}
            />

            {/* BILL CARDS */}
            <div className="row">

                {bills
                    .filter(b => (b.room || "").includes(search))
                    .map(b => (
                        <div className="col-md-4 mb-3" key={b._id}>

                            <div className="card shadow border-0">

                                {/* HEADER */}
                                <div className="card-header bg-danger text-white d-flex justify-content-between">
                                    <strong>Room {b.room}</strong>
                                    <span className="badge bg-light text-dark">{b.status}</span>
                                </div>

                                {/* BODY */}
                                <div className="card-body">

                                    {editId === b._id ? (
                                        <>
                                            <input className="form-control mb-1"
                                                value={editData.room}
                                                onChange={(e) => setEditData({ ...editData, room: e.target.value })}
                                            />

                                            <input className="form-control mb-1" type="number"
                                                value={editData.roomRent}
                                                onChange={(e) => setEditData({ ...editData, roomRent: e.target.value })}
                                            />

                                            <input className="form-control mb-1" type="number"
                                                value={editData.foodCharges}
                                                onChange={(e) => setEditData({ ...editData, foodCharges: e.target.value })}
                                            />

                                            <input className="form-control mb-1" type="number"
                                                value={editData.laundry}
                                                onChange={(e) => setEditData({ ...editData, laundry: e.target.value })}
                                            />

                                            <input className="form-control mb-1" type="number"
                                                value={editData.extraServices}
                                                onChange={(e) => setEditData({ ...editData, extraServices: e.target.value })}
                                            />

                                            <input className="form-control mb-2" type="number"
                                                value={editData.tax}
                                                onChange={(e) => setEditData({ ...editData, tax: e.target.value })}
                                            />
                                            {/* ✅ STATUS DROPDOWN */}
                                            <select
                                                className="form-select mb-2"
                                                value={editData.status}
                                                onChange={(e) =>
                                                    setEditData({ ...editData, status: e.target.value })
                                                }
                                            >
                                                <option value="Pending">Pending</option>
                                                <option value="Generated">Generated</option>
                                                <option value="Paid">Paid</option>
                                            </select>

                                            <button
                                                className="btn btn-success w-100"
                                                onClick={() => saveEdit(b._id)}
                                            >
                                                💾 Save
                                            </button>
                                        </>
                                    ) : (
                                        <>
                                            <p>🛏 Room Rent: ₹{b.roomRent}</p>
                                            <p>🍽 Food: ₹{b.foodCharges}</p>
                                            <p>🧺 Laundry: ₹{b.laundry}</p>
                                            <p>➕ Extra: ₹{b.extraServices}</p>
                                            <p>📊 Tax: {b.tax}%</p>

                                            <hr />

                                            <h5 className="text-success">
                                                💰 Total: ₹{calculateTotal(b)}
                                            </h5>

                                            <button
                                                className="btn btn-warning w-100 mb-2"
                                                onClick={() => {
                                                    setEditId(b._id);
                                                    setEditData({
                                                        room: b.room,
                                                        roomRent: b.roomRent,
                                                        foodCharges: b.foodCharges,
                                                        laundry: b.laundry,
                                                        extraServices: b.extraServices,
                                                        tax: b.tax,
                                                        status: b.status
                                                    });
                                                }}
                                            >
                                                ✏️ Edit
                                            </button>
                                        </>
                                    )}

                                    {/* ACTIONS */}
                                    <div className="d-flex gap-2 mt-3">

                                        <button
                                            className="btn btn-outline-danger w-50"
                                            onClick={() => handleDelete(b._id)}
                                        >
                                            <i className="bi bi-trash me-1"></i>
                                            Delete
                                        </button>

                                        <button
                                            className="btn btn-dark w-50"
                                            onClick={() => printBill(b)}
                                        >
                                            <i className="bi bi-printer me-1"></i>
                                            Print
                                        </button>

                                    </div>


                                </div>
                            </div>

                        </div>
                    ))}
            </div>
            <div className="card shadow-sm">

                <div className="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <span>🍽 Orders Served</span>
                    <span className="badge bg-light text-dark">3</span>
                </div>

                <div className="card-body" style={{ maxHeight: "300px", overflowY: "auto" }}>

                    {/* ITEM 1 */}
                    <div className="border-bottom pb-2 mb-3">
                        <div className="d-flex justify-content-between">
                            <strong>Room 101</strong>
                            <span className="badge bg-success">Served</span>
                        </div>
                        <small className="text-muted">Chicken Biryani</small><br />
                        <small className="text-muted">🕒 10:30 AM</small>

                        <button className="btn btn-warning btn-sm w-100 mt-2">
                            💳 Bill Order
                        </button>
                    </div>

                    {/* ITEM 2 */}
                    <div className="border-bottom pb-2 mb-3">
                        <div className="d-flex justify-content-between">
                            <strong>Room 205</strong>
                            <span className="badge bg-success">Served</span>
                        </div>
                        <small className="text-muted">Coffee + Sandwich</small><br />
                        <small className="text-muted">🕒 11:10 AM</small>

                        <button className="btn btn-warning btn-sm w-100 mt-2">
                            💳 Bill Order
                        </button>
                    </div>

                    {/* ITEM 3 */}
                    <div className="border-bottom pb-2 mb-3">
                        <div className="d-flex justify-content-between">
                            <strong>Room 302</strong>
                            <span className="badge bg-success">Served</span>
                        </div>
                        <small className="text-muted">Masala Dosa</small><br />
                        <small className="text-muted">🕒 11:45 AM</small>

                        <button className="btn btn-warning btn-sm w-100 mt-2">
                            💳 Bill Order
                        </button>
                    </div>

                </div>
            </div>
        </div>

    );
}