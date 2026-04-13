import { useState } from "react";

export default function BillingPayment() {
  const [bill, setBill] = useState({
    room: "",
    amount: "",
    tax: "",
    discount: "",
    paymentMode: "Cash"
  });

  const calculateTotal = () => {
    const base = Number(bill.amount || 0);
    const taxAmount = (base * Number(bill.tax || 0)) / 100;
    const discountAmount = (base * Number(bill.discount || 0)) / 100;

    return base + taxAmount - discountAmount;
  };

  const printReceipt = () => {
    const win = window.open("", "", "width=800,height=600");

    win.document.write(`
      <html>
      <head>
        <title>Receipt</title>
        <style>
          body { font-family: Arial; padding: 30px; }
          .box { max-width: 500px; margin: auto; border: 1px solid #ddd; padding: 20px; }
          h2 { text-align: center; }
          .row { display: flex; justify-content: space-between; margin: 10px 0; }
          .total { font-size: 22px; font-weight: bold; color: green; text-align: right; }
        </style>
      </head>

      <body>
        <div class="box">
          <h2>🏨 Mangalore International</h2>

          <div class="row"><span>Room</span><span>${bill.room}</span></div>
          <div class="row"><span>Amount</span><span>₹${bill.amount}</span></div>
          <div class="row"><span>Tax</span><span>${bill.tax}%</span></div>
          <div class="row"><span>Discount</span><span>${bill.discount}%</span></div>
          <div class="row"><span>Payment Mode</span><span>${bill.paymentMode}</span></div>

          <hr/>

          <div class="total">
            TOTAL: ₹${calculateTotal()}
          </div>

          <p style="text-align:center;margin-top:20px;">
            Thank you for staying with us ❤️
          </p>
        </div>

        <script>window.print();</script>
      </body>
      </html>
    `);

    win.document.close();
  };

  return (
    <div className="container-fluid p-4">

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h3>💳 Billing & Payment Module</h3>
        <button className="btn btn-dark">
          + Generate Bill
        </button>
      </div>

      <div className="row">

        {/* LEFT SIDE */}
        <div className="col-md-8">
          <div className="card shadow p-3">

            <div className="row g-2">

              <div className="col-md-3">
                <input
                  className="form-control"
                  placeholder="Room No"
                  value={bill.room}
                  onChange={(e) =>
                    setBill({ ...bill, room: e.target.value })
                  }
                />
              </div>

              <div className="col-md-3">
                <input
                  type="number"
                  className="form-control"
                  placeholder="Amount"
                  value={bill.amount}
                  onChange={(e) =>
                    setBill({ ...bill, amount: e.target.value })
                  }
                />
              </div>

              <div className="col-md-2">
                <input
                  type="number"
                  className="form-control"
                  placeholder="Tax %"
                  value={bill.tax}
                  onChange={(e) =>
                    setBill({ ...bill, tax: e.target.value })
                  }
                />
              </div>

              <div className="col-md-2">
                <input
                  type="number"
                  className="form-control"
                  placeholder="Discount %"
                  value={bill.discount}
                  onChange={(e) =>
                    setBill({ ...bill, discount: e.target.value })
                  }
                />
              </div>

              <div className="col-md-2">
                <select
                  className="form-select"
                  value={bill.paymentMode}
                  onChange={(e) =>
                    setBill({ ...bill, paymentMode: e.target.value })
                  }
                >
                  <option>Cash</option>
                  <option>Card</option>
                  <option>UPI</option>
                </select>
              </div>

            </div>

            {/* TOTAL */}
            <div className="mt-3 p-3 bg-light rounded">
              <h5>
                💰 Total Payable:{" "}
                <span className="text-success">
                  ₹{calculateTotal()}
                </span>
              </h5>
            </div>

            {/* BUTTONS */}
            <div className="d-flex gap-2 mt-3">

              <button className="btn btn-success w-50">
                💾 Save Bill
              </button>

              <button
                className="btn btn-primary w-50"
                onClick={printReceipt}
              >
                🖨 Print Receipt
              </button>

            </div>

          </div>
        </div>

        {/* RIGHT SIDE */}
        <div className="col-md-4">
          <div className="card shadow p-3">

            <h5>📊 Payment Summary</h5>
            <hr />

            <p>Cash Payments: ₹12,000</p>
            <p>Card Payments: ₹8,500</p>
            <p>UPI Payments: ₹15,000</p>

            <hr />

            <h5 className="text-success">
              Total Revenue: ₹35,500
            </h5>

          </div>
        </div>

      </div>
    </div>
  );
}