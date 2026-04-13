import axios from "axios";
import { useEffect, useState } from "react";

export default function Housekeeping() {
    const [showForm, setShowForm] = useState(false);
    const [search, setSearch] = useState("");

    const [newTask, setNewTask] = useState({
        room: "",
        staff: "",
        status: "Dirty"
    });
    const [rooms, setRooms] = useState([]);

    useEffect(() => {
        fetchRooms();
    }, []);

    const fetchRooms = async () => {
        try {
            const res = await axios.get("http://localhost:5000/api/housekeeping");
            console.log("DATA FROM BACKEND:", res.data);
            setRooms(res.data);
        } catch (err) {
            console.log(err);
        }
    };
    const updateStatus = async (id, status) => {
        await axios.put(`http://localhost:5000/api/housekeeping/${id}`, {
            status
        });

        fetchRooms(); // refresh
    };

    const handleDelete = async (id) => {
        console.log("Deleting ID:", id); // 🔥 ADD THIS

        try {
            await axios.delete(`http://localhost:5000/api/housekeeping/${id}`);

            setRooms(prev => prev.filter(r => r._id !== id));

        } catch (err) {
            console.log("DELETE ERROR:", err);
        }
    };



    const addTask = async () => {
        try {
            console.log("Sending:", newTask);

            if (!newTask.room || !newTask.staff) {
                alert("Enter all fields");
                return;
            }

            const res = await axios.post(
                "http://localhost:5000/api/housekeeping",
                newTask
            );

            console.log("Response:", res.data);

            fetchRooms();

            setNewTask({ room: "", staff: "", status: "Dirty" });
            setShowForm(false);

        } catch (err) {
            console.log("ERROR:", err);
            alert("Error saving task");
        }
    };

    return (
        <div className="container-fluid">

            {/* HEADER */}
            <div className="d-flex justify-content-between align-items-center mb-4">
                <h3><i className="bi bi-bucket"></i> Housekeeping Management</h3>
                <button
                    className="btn btn-warning"
                    onClick={() => setShowForm(!showForm)}
                >
                    + Assign Task
                </button>
            </div>

            {showForm && (
                <div className="card p-3 mb-3">

                    <div className="row">

                        <div className="col-md-3">
                            <input
                                className="form-control"
                                placeholder="Room No"
                                value={newTask.room}
                                onChange={(e) =>
                                    setNewTask({ ...newTask, room: e.target.value })
                                }
                            />
                        </div>

                        <div className="col-md-3">
                            <input
                                className="form-control"
                                placeholder="Staff Name"
                                value={newTask.staff}
                                onChange={(e) =>
                                    setNewTask({ ...newTask, staff: e.target.value })
                                }
                            />
                        </div>

                        <div className="col-md-3">
                            <select
                                className="form-select"
                                value={newTask.status}
                                onChange={(e) =>
                                    setNewTask({ ...newTask, status: e.target.value })
                                }
                            >
                                <option>Dirty</option>
                                <option>Cleaning</option>
                                <option>Clean</option>
                                <option>Maintenance</option>
                            </select>
                        </div>

                        <div className="col-md-3">
                            <button className="btn btn-success w-100" onClick={addTask}>
                                Assign
                            </button>
                        </div>

                    </div>

                </div>
            )}
            <input
                className="form-control mb-3"
                placeholder="Search Room..."
                onChange={(e) => setSearch(e.target.value)}
            />


            {/* TABLE */}
            <div className="card card-premium">
                <div className="card-header bg-danger text-white">
                    Room Cleaning Status
                </div>

                <table className="table">
                    <thead>
                        <tr>
                            <th>Room No</th>
                            <th>Assigned Staff</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        {rooms
                            .filter((r) => r.room.toString().includes(search))
                            .map((r) => (
                                <tr key={r._id}>
                                    <td>{r.room}</td>
                                    <td>{r.staff ? r.staff : "No Staff"}</td>

                                    <td>
                                        <span className={`badge ${getBadge(r.status)}`}>
                                            {r.status}
                                        </span>
                                    </td>

                                    <td>
                                        <select
                                            className="form-select"
                                            value={r.status}
                                            onChange={(e) =>
                                                updateStatus(r._id, e.target.value)
                                            }
                                        >
                                            <option>Dirty</option>
                                            <option>Cleaning</option>
                                            <option>Clean</option>
                                            <option>Maintenance</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button
                                            className="btn btn-danger btn-sm"
                                            onClick={() => handleDelete(r._id)}
                                        >
                                            <i className="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            ))}
                    </tbody>
                </table>
            </div>

        </div>
    );
}

/* BADGE COLORS */
function getBadge(status) {
    switch (status) {
        case "Dirty":
            return "bg-danger";
        case "Cleaning":
            return "bg-warning text-dark";
        case "Clean":
            return "bg-success";
        case "Maintenance":
            return "bg-secondary";
        default:
            return "bg-light";
    }
}