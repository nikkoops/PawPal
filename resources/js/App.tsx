import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import AcknowledgeAgreement from './pages/AcknowledgeAgreement';

const App: React.FC = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/adoption/acknowledgment" element={<AcknowledgeAgreement />} />
        {/* Add more routes here as needed */}
      </Routes>
    </BrowserRouter>
  );
};

export default App;
