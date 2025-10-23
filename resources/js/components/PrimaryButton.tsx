import React from 'react';

interface PrimaryButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  children: React.ReactNode;
}

const PrimaryButton: React.FC<PrimaryButtonProps> = ({ children, ...props }) => (
  <button
    {...props}
    style={{
      backgroundColor: '#fe7701',
      color: 'white',
      padding: '0.75rem 1.5rem',
      borderRadius: '0.5rem',
      fontWeight: 600,
      fontSize: '1rem',
      border: 'none',
      cursor: props.disabled ? 'not-allowed' : 'pointer',
      opacity: props.disabled ? 0.6 : 1,
      width: props.className?.includes('w-full') ? '100%' : undefined,
    }}
  >
    {children}
  </button>
);

export default PrimaryButton;
