import React from 'react';

const Layout: React.FC<{ children: React.ReactNode }> = ({ children }) => (
  <div style={{ background: '#f8fafc', minHeight: '100vh' }}>
    {/* Add header, nav, etc. here if needed */}
    {children}
  </div>
);

export default Layout;
