<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    main {
        flex: 1;
        width: 100%;
    }

    #map {
        height: 300px;
    }

    #loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        display: none;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s ease;
    }

    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #loading p {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    #error-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #e74c3c;
        color: white;
        padding: 20px;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 8px;
        display: none;
        z-index: 1000;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s ease;
    }

    #error-message i {
        margin-right: 8px;
        font-size: 1.5rem;
    }

    .district-tooltip {
        background-color: white;
        color: black;
        font-size: 8px;
        font-weight: bold;
        padding: 0px 2px;
        border-radius: 3px;
        border: 1px solid #ccc;
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .district-tooltip.hovered-tooltip {
        background-color: #3388ff;
        color: white;
        opacity: 1;
        border-color: #0056b3;
    }

    .legend-card {
        background: rgba(255, 255, 255, 0.9);
        padding: 10px 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        font-size: 0.9rem;
        line-height: 1.5;
        color: #333;
        border: 1px solid #ddd;
        position: relative;
        z-index: 1000;
    }

    .legend-title {
        font-weight: bold;
        margin-bottom: 8px;
        color: #444;
        text-align: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .legend-card i {
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-right: 8px;
        border-radius: 4px;
    }

    .hidden-mobile {
        display: block;
    }

    footer {
        background-color: #2d3748;
        /* warna abu-abu gelap */
        color: #e2e8f0;
        /* warna teks abu-abu muda */
        font-size: 0.875rem;
        /* ukuran font kecil */
        text-align: center;
    }


    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .fade-out {
        animation: fadeOut 0.5s ease-out forwards;
    }

    @media (max-width: 768px) {
        .legend-card {
            position: fixed;
            bottom: 60px;
            left: 10px;
            z-index: 1000;
            width: 95%;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
        }

        .hidden-mobile {
            display: none;
        }
    }

    @media (min-width: 1024px) {
        #map {
            height: 500px;
        }

        .district-tooltip {
            background-color: white;
            color: black;
            font-size: 12px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            opacity: 0.8;
            transition: all 0.3s ease;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>
