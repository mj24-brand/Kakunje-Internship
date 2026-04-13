import axios from "axios";
import { useEffect, useState } from "react";

export default function RoomService() {
    const [showForm, setShowForm] = useState(false);
    const [orders, setOrders] = useState([]);
    const [search, setSearch] = useState("");
    const [activities, setActivities] = useState([]);

    const [newOrder, setNewOrder] = useState({
        room: "",
        item: "",
        qty: 1,
        status: "Pending"
    });

    useEffect(() => {
        fetchOrders();
    }, []);

    const fetchOrders = async () => {
        const res = await axios.get("http://localhost:5000/api/roomservice");
        setOrders(res.data);
    };

    const addActivity = (text) => {
        setActivities(prev => [
            { text, time: new Date() },
            ...prev
        ]);
    };

    const addOrder = async () => {
        if (!newOrder.room || !newOrder.item) {
            alert("Enter all fields");
            return;
        }

        await axios.post("http://localhost:5000/api/roomservice", newOrder);

        addActivity(`New order: Room ${newOrder.room} - ${newOrder.item}`);

        fetchOrders();
        setNewOrder({ room: "", item: "", qty: 1, status: "Pending" });
        setShowForm(false);
    };

   const updateStatus = async (id, status, room, item) => {
    await axios.put(`http://localhost:5000/api/roomservice/${id}`, { status });

    addActivity(`Room ${room} - ${item} → ${status}`);

    // ✅ THIS IS THE MAGIC PART
    if (status === "Added to Bill") {
        await axios.post("http://localhost:5000/api/roombilling", {
            room,
            foodCharges: 0,
            roomRent: 0,
            laundry: 0,
            extraServices: 0,
            tax: 0,
            status: "Pending"
        });

        addActivity(`🧾 Bill created for Room ${room}`);
    }

    fetchOrders();
};
    const handleDelete = async (id) => {
        if (!window.confirm("Delete this order?")) return;

        await axios.delete(`http://localhost:5000/api/roomservice/${id}`);

        setOrders(prev => prev.filter(o => o._id !== id));

        addActivity(`Order deleted (ID: ${id})`);
    };

    return (
        <div className="container-fluid">
            <div className="row">

                {/* LEFT SIDE */}
                <div className="col-md-9">

                    {/* HEADER */}
                    <div className="d-flex justify-content-between align-items-center mb-4">
                        <h3><i className="bi bi-box-seam-fill"></i> Room Service Management</h3>
                        <button
                            className="btn btn-primary"
                            onClick={() => setShowForm(!showForm)}
                        >
                            + New Order
                        </button>
                    </div>

                    {/* FORM */}
                    {showForm && (
                        <div className="card p-3 mb-3">
                            <div className="row">

                                <div className="col-md-3">
                                    <input
                                        className="form-control"
                                        placeholder="Room No"
                                        value={newOrder.room}
                                        onChange={(e) =>
                                            setNewOrder({ ...newOrder, room: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-3">
                                    <input
                                        className="form-control"
                                        placeholder="Item"
                                        value={newOrder.item}
                                        onChange={(e) =>
                                            setNewOrder({ ...newOrder, item: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-2">
                                    <input
                                        type="number"
                                        className="form-control"
                                        value={newOrder.qty}
                                        onChange={(e) =>
                                            setNewOrder({ ...newOrder, qty: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-2">
                                    <select
                                        className="form-select"
                                        value={newOrder.status}
                                        onChange={(e) =>
                                            setNewOrder({ ...newOrder, status: e.target.value })
                                        }
                                    >
                                        <option>Pending</option>
                                        <option>Sent to Kitchen</option>
                                        <option>Served</option>
                                        <option>Added to Bill</option>
                                    </select>
                                </div>

                                <div className="col-md-2">
                                    <button
                                        className="btn btn-success w-100"
                                        onClick={addOrder}
                                    >
                                        Save
                                    </button>
                                </div>

                            </div>
                        </div>
                    )}

                    {/* SEARCH */}
                    <input
                        className="form-control mb-3"
                        placeholder="Search Room..."
                        onChange={(e) => setSearch(e.target.value)}
                    />

                    {/* TABLE */}
                    <div className="card card-premium">
                        <div className="card-header bg-danger text-white">
                            Room Service Orders
                        </div>

                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                {orders
                                    .filter(o => o.room.toString().includes(search))
                                    .map(o => (
                                        <tr key={o._id}>
                                            <td>{o.room}</td>
                                            <td>{o.item}</td>
                                            <td>{o.qty}</td>

                                            <td>
                                                <span className={`badge ${getBadge(o.status)}`}>
                                                    {o.status}
                                                </span>
                                            </td>

                                            <td>
                                                <select
                                                    className="form-select"
                                                    value={o.status}
                                                    onChange={(e) =>
                                                        updateStatus(o._id, e.target.value, o.room, o.item)
                                                    }
                                                >
                                                    <option>Pending</option>
                                                    <option>Sent to Kitchen</option>
                                                    <option>Served</option>
                                                    <option>Added to Bill</option>
                                                </select>
                                            </td>

                                            <td>
                                                <i
                                                    className="bi bi-trash text-danger"
                                                    style={{ cursor: "pointer" }}
                                                    onClick={() => handleDelete(o._id)}
                                                ></i>
                                            </td>
                                        </tr>
                                    ))}
                            </tbody>
                        </table>
                    </div>

                </div>

                {/* RIGHT SIDE - LIVE ACTIVITY */}
                <div className="col-md-3">

                    <div className="card shadow-sm">
                        <div className="card-header bg-dark text-white">
                            🔔 Live Activity
                        </div>

                        <div
                            className="card-body"
                            style={{ maxHeight: "500px", overflowY: "auto" }}
                        >
                            {activities.length === 0 && (
                                <p className="text-muted">No recent activity</p>
                            )}

                            {activities.map((a, i) => (
                                <div key={i} className="mb-2 border-bottom pb-2">
                                    <small>{a.text}</small>
                                    <br />
                                    <small className="text-muted">
                                        {new Date(a.time).toLocaleTimeString()}
                                    </small>
                                </div>
                            ))}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    );
}

/* STATUS COLORS */
function getBadge(status) {
    switch (status) {
        case "Pending":
            return "bg-warning text-dark";
        case "Sent to Kitchen":
            return "bg-info";
        case "Served":
            return "bg-success";
        case "Added to Bill":
            return "bg-secondary";
        default:
            return "bg-light";
    }
}