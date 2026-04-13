import axios from "axios";
import { useEffect, useState } from "react";

export default function AmenityService() {

    const [showForm, setShowForm] = useState(false);

    // ✅ SERVICES WITH DESCRIPTION
    const [services, setServices] = useState([
        { name: "Laundry", charge: 200, desc: "Washing and ironing of clothes" },
        { name: "Extra Bed", charge: 500, desc: "Additional bed for guest comfort" },
        { name: "Airport Pickup", charge: 800, desc: "Pickup service from airport" },
        { name: "WiFi", charge: 100, desc: "High-speed internet access" },
        { name: "Spa", charge: 1500, desc: "Relaxing spa and wellness service" }
    ]);

    const [newService, setNewService] = useState({
        name: "",
        charge: "",
        desc: ""
    });

    const [activeServices, setActiveServices] = useState([]);

    useEffect(() => {
        fetchServices();
    }, []);

    const fetchServices = async () => {
        try {
            const res = await axios.get("http://localhost:5000/api/services");
            setActiveServices(res.data);
        } catch (err) {
            console.log(err);
        }
    };

    // ✅ TOTAL BILL
    const total = activeServices
        .filter(a => a.status === "Billed")
        .reduce((sum, a) => sum + a.charge, 0);

    return (
        <div className="container-fluid p-4">

            <div className="row">

                {/* LEFT SIDE */}
                <div className="col-md-8">

                    <div className="d-flex justify-content-between align-items-center mb-3">
                        <h3>🛎 Amenity / Service Management</h3>
                        <button
                            className="btn btn-dark"
                            onClick={() => setShowForm(!showForm)}
                        >
                            + Add Service
                        </button>
                    </div>

                    {/* ADD SERVICE FORM */}
                    {showForm && (
                        <div className="card p-3 mb-3">
                            <div className="row">

                                <div className="col-md-4">
                                    <input
                                        className="form-control"
                                        placeholder="Service Name"
                                        value={newService.name}
                                        onChange={(e) =>
                                            setNewService({ ...newService, name: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-3">
                                    <input
                                        type="number"
                                        className="form-control"
                                        placeholder="Charge"
                                        value={newService.charge}
                                        onChange={(e) =>
                                            setNewService({ ...newService, charge: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-3">
                                    <input
                                        className="form-control"
                                        placeholder="Description"
                                        value={newService.desc}
                                        onChange={(e) =>
                                            setNewService({ ...newService, desc: e.target.value })
                                        }
                                    />
                                </div>

                                <div className="col-md-2">
                                    <button
                                        className="btn btn-success w-100"
                                        onClick={() => {
                                            if (!newService.name || !newService.charge) {
                                                return alert("Enter all fields");
                                            }

                                            setServices([
                                                ...services,
                                                {
                                                    name: newService.name,
                                                    charge: Number(newService.charge),
                                                    desc: newService.desc
                                                }
                                            ]);

                                            setNewService({ name: "", charge: "", desc: "" });
                                            setShowForm(false);
                                        }}
                                    >
                                        Save
                                    </button>
                                </div>

                            </div>
                        </div>
                    )}

                    {/* SERVICE CARDS */}
                    <div className="row">

                        {services.map((s, i) => (
                            <div className="col-md-6 mb-3" key={i}>

                                <div className="card shadow-sm border-0">

                                    <div className="card-header bg-danger text-white d-flex justify-content-between">
                                        <strong>{s.name}</strong>
                                        <span>₹{s.charge}</span>
                                    </div>

                                    <div className="card-body">

                                        {/* ✅ DESCRIPTION */}
                                        <p className="text-muted mb-2" style={{ fontSize: "14px" }}>
                                            {s.desc}
                                        </p>

                                        <button
                                            className="btn btn-dark w-100"
                                            onClick={async () => {
                                                const room = prompt("Enter Room No");

                                                if (!room) return alert("Room required");

                                                try {
                                                    await axios.post("http://localhost:5000/api/services", {
                                                        room,
                                                        serviceName: s.name,
                                                        charge: s.charge
                                                    });

                                                    fetchServices();
                                                } catch (err) {
                                                    console.log(err);
                                                    alert("Error adding service");
                                                }
                                            }}
                                        >
                                            ➕ Add to Bill
                                        </button>

                                    </div>

                                </div>

                            </div>
                        ))}

                    </div>

                </div>

                {/* RIGHT SIDE */}
                <div className="col-md-4">

                    {/* ACTIVE SERVICES */}
                    <div className="card shadow-sm mb-3">
                        <div className="card-header bg-success text-white">
                            🧾 Active Services
                        </div>

                        <div className="card-body" style={{ maxHeight: "250px", overflowY: "auto" }}>

                            {activeServices
                                .filter(a => a.status !== "Billed")
                                .map((a) => (
                                    <div key={a._id} className="border-bottom pb-2 mb-2">
                                        <strong>Room {a.room}</strong><br />
                                        <small>{a.serviceName}</small><br />
                                        <small className="text-muted">₹{a.charge}</small>

                                        <button
                                            className="btn btn-dark btn-sm w-100 mt-2"
                                            onClick={async () => {
                                                try {
                                                    // Update status
                                                    const res1 = await axios.put(
                                                        `http://localhost:5000/api/services/${a._id}`,
                                                        { status: "Billed" }
                                                    );

                                                    console.log("Service Updated:", res1.data);

                                                    // Send to billing
                                                    const res2 = await axios.post(
                                                        "http://localhost:5000/api/roombilling/add-service",
                                                        {
                                                            room: a.room,
                                                            amount: a.charge
                                                        }
                                                    );

                                                    console.log("Billing Updated:", res2.data);

                                                    fetchServices();

                                                } catch (err) {
                                                    console.log("FULL ERROR:", err.response?.data || err.message);
                                                    alert("Error updating bill");
                                                }
                                            }}
                                        >
                                            Bill Update
                                        </button>
                                    </div>
                                ))}

                        </div>
                    </div>

                    {/* BILLED SERVICES */}
                    <div className="card shadow-sm mb-3">
                        <div className="card-header bg-secondary text-white">
                            💰 Billed Services
                        </div>

                        <div className="card-body" style={{ maxHeight: "200px", overflowY: "auto" }}>

                            {activeServices
                                .filter(a => a.status === "Billed")
                                .map((a) => (
                                    <div key={a._id} className="border-bottom pb-2 mb-2">
                                        <strong>Room {a.room}</strong><br />
                                        <small>{a.serviceName}</small><br />
                                        <small className="text-muted">₹{a.charge}</small>
                                    </div>
                                ))}

                        </div>
                    </div>

                    {/* TOTAL BILL */}
                    <div className="card shadow-sm text-center p-3">
                        <h5>Total Bill</h5>
                        <h3 className="text-success">₹{total}</h3>
                    </div>

                </div>

            </div>

        </div>
    );
}