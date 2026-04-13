import { BrowserRouter, Routes, Route } from "react-router-dom";
import { useState } from "react";

import Sidebar from "./components/layout/Sidebar.jsx";
import Header from "./components/layout/Header.jsx";
import Footer from "./components/layout/Footer.jsx";

import Dashboard from "./pages/dashboard/Dashboard.jsx";
import Housekeeping from "./pages/lodge/housekeeping/Housekeeping";
import RoomService from "./pages/lodge/room_service/roomService";
import RoomBilling from "./pages/lodge/room_billing/roomBilling";
import AmenityService from "./pages/lodge/aminity/aminity.jsx";
import RoomCalendar from "./pages/lodge/room_availability/roomCalender.jsx";

import BillingPayment from "./pages/restaurant/billing/billing.jsx";
import Inventory from "./pages/restaurant/inventory/inventory.jsx";
import SupplierManagement from "./pages/restaurant/suppliers/SupplierManagement.jsx";
import PurchaseManagement from "./pages/restaurant/purchase/PurchaseManagement.jsx";
import ReservationManagement from "./pages/restaurant/reservation/ReservationManagement";

function App() {
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const toggleSidebar = () => {
    setSidebarOpen(prev => !prev);
  };

  const closeSidebar = () => {
    setSidebarOpen(false);
  };

  return (
    <BrowserRouter>
      <div className="app-layout">

        {/* SIDEBAR */}
        <Sidebar isOpen={sidebarOpen} closeSidebar={closeSidebar} />

        {/* MAIN */}
        <div className="main-content">

          <Header toggleSidebar={toggleSidebar} />

          <div className="p-4">
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route path="/housekeeping" element={<Housekeeping />} />
              <Route path="/room-service" element={<RoomService />} />
              <Route path="/room-billing" element={<RoomBilling />} />
              <Route path="/amenity" element={<AmenityService />} />
              <Route path="/room_avail" element={<RoomCalendar />} />

              <Route path="/billing" element={<BillingPayment />} />
              <Route path="/inventory" element={<Inventory />} />
              <Route path="/supplier" element={<SupplierManagement />} />
              <Route path="/purchase" element={<PurchaseManagement />} />
              <Route path="/reservation" element={<ReservationManagement />} />
            </Routes>
          </div>

          <Footer />

        </div>
      </div>
    </BrowserRouter>
  );
}

export default App;