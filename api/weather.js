export default async function handler(req, res) {
  const { city } = req.query;
  const apiKey = process.env.WEATHER_API_KEY;
  const units = req.query.units || 'metric';
  
  try {
    const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=${units}`);
    const data = await response.json();
    res.status(200).json(data);
  } catch (error) {
    res.status(500).json({ error: 'Error fetching weather data' });
  }
}