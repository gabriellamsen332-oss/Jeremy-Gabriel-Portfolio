const PDFDocument = require('pdfkit');

export default async function handler(req, res) {
  try {
    const doc = new PDFDocument({
      size: 'A4',
      margins: {
        top: 50,
        bottom: 50,
        left: 50,
        right: 50
      }
    });

    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', 'attachment; filename="Jeremy_Gabriel_Resume.pdf"');

    doc.pipe(res);

    doc.fontSize(24).fillColor('#ff0000').text('JEREMY GABRIEL L. BATAC', { align: 'center' });
    doc.moveDown(0.5);
    doc.fontSize(14).fillColor('#000000').text('IT Student', { align: 'center' });
    doc.moveDown(0.3);
    doc.fontSize(10).fillColor('#333333').text('gabriellamsen332@gmail.com', { align: 'center' });
    doc.text('Arellano St., Pantal, Dagupan City, 2400, North Luzon, Philippines', { align: 'center' });
    
    doc.moveDown(1.5);
    doc.fontSize(16).fillColor('#ff0000').text('PERSONAL INFORMATION', { underline: true });
    doc.moveDown(0.5);
    doc.fontSize(11).fillColor('#000000');
    doc.text(`Age: 19`);
    doc.text(`Block: 21-ITE-04`);
    doc.text(`School: Universidad De Dagupan`);
    
    doc.moveDown(1.5);
    doc.fontSize(16).fillColor('#ff0000').text('ABOUT ME', { underline: true });
    doc.moveDown(0.5);
    doc.fontSize(11).fillColor('#000000');
    doc.text('I am a 19-year-old Information Technology student at the Universidad De Dagupan, currently in Block 21-ITE-04. I am passionate about learning new technologies and developing my skills in programming and web development.', {
      align: 'justify'
    });
    
    doc.moveDown(1.5);
    doc.fontSize(16).fillColor('#ff0000').text('SKILLS', { underline: true });
    doc.moveDown(0.5);
    doc.fontSize(11).fillColor('#000000');
    
    const skills = [
      'HTML & CSS',
      'JavaScript',
      'PHP',
      'Database Management',
      'Programming Fundamentals'
    ];
    
    skills.forEach(skill => {
      doc.text(`• ${skill}`);
    });
    
    doc.moveDown(2);
    doc.fontSize(8).fillColor('#666666').text('Generated on ' + new Date().toLocaleDateString(), { align: 'center' });

    doc.end();
  } catch (error) {
    console.error('PDF generation error:', error);
    res.status(500).json({ error: 'Failed to generate PDF' });
  }
}
