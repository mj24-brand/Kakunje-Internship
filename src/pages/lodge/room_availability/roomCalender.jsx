import axios from "axios";
import { useEffect, useState } from "react";

export default function RoomCalendar() {

    const [date, setDate] = useState("");
    const [rooms, setRooms] = useState([]);

    // sample room list
    const roomList = ["101", "102", "103", "104", "201", "202"];

    useEffect(() => {
        if (date) fetchRooms();
    }, [date]);

    const fetchRooms = async () => {
        try {
            const res = await axios.get(`http://localhost:5000/api/rooms/${date}`);
            setRooms(res.data);
        } catch (err) {
            console.log(err);
        }
    };

    const getStatus = (roomNo) => {
        const found = rooms.find(r => r.roomNumber === roomNo);
        return found ? found.status : "Available";
    };

    const updateStatus = async (roomNo, status) => {
        try {
            await axios.post("http://localhost:5000/api/rooms", {
                roomNumber: roomNo,
                date,
                status
            });
            fetchRooms();
        } catch (err) {
            console.log(err);
        }
    };

    const getColor = (status) => {
        switch (status) {
            case "Available":
                return "bg-success";
            case "Occupied":
                return "bg-danger";
            case "Reserved":
                return "bg-warning text-dark";
            default:
                return "bg-secondary";
        }
    };

    return (
        <div className="container-fluid p-4">

            <h3 className="mb-3">📅 Room Availability Calendar</h3>

            {/* DATE PICKER */}
            <div className="mb-4">
                <input
                    type="date"
                    className="form-control w-25"
                    onChange={(e) => setDate(e.target.value)}
                />
            </div>

            {/* ROOM GRID */}
            <div className="row">

                {roomList.map((room) => {
                    const status = getStatus(room);

                    return (
                        <div className="col-md-3 mb-3" key={room}>

                            <div className="card shadow-sm">

                                <div className={`card-header text-white ${getColor(status)}`}>
                                    Room {room}
                                </div>

                                <div className="card-body text-center">

                                    <h6>Status: {status}</h6>

                                    <select
                                        className="form-select mt-2"
                                        value={status}
                                        onChange={(e) =>
                                            updateStatus(room, e.target.value)
                                        }
                                    >
                                        <option>Available</option>
                                        <option>Occupied</option>
                                        <option>Reserved</option>
                                    </select>

                                </div>

                            </div>

                        </div>
                    );
                })}

            </div>

        </div>
    );
}