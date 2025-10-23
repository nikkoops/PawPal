import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Layout from '../components/Layout'; // Adjust path as needed
import PrimaryButton from '../components/PrimaryButton'; // Adjust path as needed

const AcknowledgeAgreement: React.FC = () => {
  const [agreed, setAgreed] = useState(false);
  const navigate = useNavigate();

  const handleContinue = () => {
    if (agreed) {
      navigate('/adoption/application');
    }
  };

  return (
    <Layout>
      <div className="max-w-xl mx-auto bg-white rounded-lg shadow-lg p-8 mt-10">
        <h2 className="text-2xl font-bold text-center mb-2">🐾 PAWPAL Adoption Application</h2>
        <h3 className="text-lg font-semibold text-center mb-6">Acknowledgment & Agreement</h3>
        <p className="mb-4 text-center text-gray-700">
          Welcome to PAWPAL!<br />
          Before proceeding with your adoption application, please review the terms and conditions below. Your consent ensures transparency and mutual understanding throughout the adoption process.
        </p>
        <hr className="mb-6" />
        <div className="mb-4">
          <h4 className="font-semibold mb-2">📜 Privacy & Data Policy</h4>
          <p className="text-gray-700">
            By continuing, you consent to the collection and processing of your personal information—including your contact details, living situation, and pet ownership history—for the purpose of evaluating your suitability as an adopter.<br />
            PAWPAL and its partner shelters will not share or sell your data to third parties without your consent, except as required by law.
          </p>
        </div>
        <div className="mb-4">
          <h4 className="font-semibold mb-2">🏠 Adoption Responsibility</h4>
          <ul className="list-disc pl-5 text-gray-700">
            <li>You understand that adopting a pet is a lifelong commitment involving care, time, and financial responsibility.</li>
            <li>You agree to provide proper food, shelter, medical care, and affection to your adopted pet.</li>
            <li>If you are no longer able to care for your pet, you will notify PAWPAL or the partner shelter rather than abandon or transfer the animal without permission.</li>
          </ul>
        </div>
        <div className="mb-4">
          <h4 className="font-semibold mb-2">⚖️ Shelter Rights</h4>
          <ul className="list-disc pl-5 text-gray-700">
            <li>PAWPAL and its partner shelters reserve the right to approve or decline applications based on their evaluation.</li>
            <li>Conduct home or background checks if deemed necessary.</li>
            <li>Reclaim an adopted pet if evidence of neglect, abuse, or policy violation arises.</li>
          </ul>
        </div>
        <div className="mb-6">
          <h4 className="font-semibold mb-2">💬 Confirmation</h4>
          <ul className="list-disc pl-5 text-gray-700">
            <li>You have read, understood, and agree to all terms and policies above.</li>
            <li>All information you provide in the next sections will be true and accurate to the best of your knowledge.</li>
          </ul>
        </div>
        <div className="flex items-center mb-6">
          <input
            type="checkbox"
            id="agree"
            checked={agreed}
            onChange={e => setAgreed(e.target.checked)}
            className="mr-2 accent-orange-500"
          />
          <label htmlFor="agree" className="text-gray-800">
            I have read and agree to the terms and conditions stated above.
          </label>
        </div>
        <PrimaryButton
          disabled={!agreed}
          onClick={handleContinue}
          className="w-full"
        >
          ➡️ I Acknowledge and Agree
        </PrimaryButton>
      </div>
    </Layout>
  );
};

export default AcknowledgeAgreement;
